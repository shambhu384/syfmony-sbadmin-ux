<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\EmployeeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;


class EmployeeController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/employees", name="employee_index")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('employee/index.html.twig', [
            'employees' => $userRepository->findEmployees()
        ]);
    }

    /**
     * @Route("/employees/profile/{id}", name="employee_profile")
     */
    public function profile(int $id, UserRepository $userRepository): Response
    {
        if (!$user = $userRepository->find($id)) {
            $user = $this->getUser();
        }
        return $this->render('employee/profile.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/employees/{id}/edit", name="employee_profile_edit")
     */
    public function new(User $user, Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(EmployeeType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('profilePic')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('user_profile_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setProfilePic($newFilename);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('employee_profile', ['id' => $user->getId()]);
        }

        return $this->render('employee/profile-edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
