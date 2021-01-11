<?php

namespace App\Controller;

use App\Entity\Leave;
use App\Form\LeaveType;
use App\Form\LeaveApprovalType;
use App\Repository\LeaveRepository;
use App\Repository\LeaveCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/leave")
 */
class LeaveController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     *
     * @Route("/applications", name="leave_applications", methods={"GET"})
     */
    public function index(LeaveRepository $leaveRepository): Response
    {
        return $this->render('leave/applications.html.twig', [
            'leaves' => $leaveRepository->findAll([], [], ['id' => 'DESC'])
        ]);
    }

    /**
     * @Route("/", name="leave_index", methods={"GET"})
     */
    public function userIndex(LeaveRepository $leaveRepository): Response
    {
        return $this->render('leave/index.html.twig', [
            'leaves' => $leaveRepository->findAll(),
        ]);
    }

    /**
     * @Route("/credit", name="leave_credit", methods={"GET"})
     */
    public function credit(LeaveCreditRepository $leaveCreditRepository): Response
    {
        return $this->render('leave/credit.html.twig', [
            'leave_credits' => $leaveCreditRepository->findBy(['user' => $this->getUser()]),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/applications/{id}/approval", name="leave_application_action", methods={"GET","POST"})
     */
    public function approval(Leave $leave, Request $request): Response
    {
        $form = $this->createForm(LeaveApprovalType::class, $leave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $leave->setUpdatedAt(new \DateTime('now'));
            $entityManager->persist($leave);
            $entityManager->flush();

            return $this->redirectToRoute('leave_applications');
        }

        return $this->render('leave/approval.html.twig', [
            'leave' => $leave,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/new", name="leave_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $leave = new Leave();
        $form = $this->createForm(LeaveType::class, $leave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $leave->setStatus(Leave::REQUESTED);
            $leave->setUser($this->getUser());
            $leave->setCreatedAt(new \DateTime('now'));
            $entityManager->persist($leave);
            $entityManager->flush();

            return $this->redirectToRoute('leave_index');
        }

        return $this->render('leave/new.html.twig', [
            'leave' => $leave,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="leave_show", methods={"GET"})
     */
    public function show(Leave $leave): Response
    {
        return $this->render('leave/show.html.twig', [
            'leave' => $leave,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="leave_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Leave $leave): Response
    {
        $form = $this->createForm(LeaveType::class, $leave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('leave_index');
        }

        return $this->render('leave/edit.html.twig', [
            'leave' => $leave,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="leave_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Leave $leave): Response
    {
        if ($this->isCsrfTokenValid('delete'.$leave->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($leave);
            $entityManager->flush();
        }

        return $this->redirectToRoute('leave_index');
    }
}
