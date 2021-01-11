<?php

namespace App\Controller;

use App\Entity\Onboarding;
use App\Form\OnboardingType;
use App\Repository\OnboardingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/onboarding")
 */
class OnboardingController extends AbstractController
{
    /**
     * @Route("/", name="onboarding_index", methods={"GET"})
     */
    public function index(OnboardingRepository $onboardingRepository): Response
    {
        return $this->render('onboarding/index.html.twig', [
            'onboardings' => $onboardingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/converted", name="onboarding_converted", methods={"GET"})
     */
    public function converted(OnboardingRepository $onboardingRepository): Response
    {
        return $this->render('onboarding/converted.html.twig', [
            'onboardings' => $onboardingRepository->findBy(['user' => $this->getUser(), 'response' => Onboarding::TYPE_INTERESTED]),
        ]);
    }

    /**
     * @Route("/history", name="onboarding_history", methods={"GET"})
     */
    public function history(OnboardingRepository $onboardingRepository): Response
    {
        return $this->render('onboarding/history.html.twig', [
            'onboardings' => $onboardingRepository->findBy(['user' => $this->getUser()]),
        ]);
    }

    /**
     * @Route("/new", name="onboarding_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $onboarding = new Onboarding();
        $form = $this->createForm(OnboardingType::class, $onboarding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $onboarding->setUser($this->getUser());
            $entityManager->persist($onboarding);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );


            return $this->redirectToRoute('onboarding_index');
        }

        return $this->render('onboarding/new.html.twig', [
            'onboarding' => $onboarding,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="onboarding_show", methods={"GET"})
     */
    public function show(Onboarding $onboarding): Response
    {
        return $this->render('onboarding/show.html.twig', [
            'onboarding' => $onboarding,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="onboarding_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Onboarding $onboarding): Response
    {
        $form = $this->createForm(OnboardingType::class, $onboarding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('onboarding_index');
        }

        return $this->render('onboarding/edit.html.twig', [
            'onboarding' => $onboarding,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="onboarding_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Onboarding $onboarding): Response
    {
        if ($this->isCsrfTokenValid('delete'.$onboarding->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($onboarding);
            $entityManager->flush();
        }

        return $this->redirectToRoute('onboarding_index');
    }
}
