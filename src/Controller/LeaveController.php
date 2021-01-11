<?php

namespace App\Controller;

use App\Entity\Leave;
use App\Form\LeaveType;
use App\Repository\LeaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/leave")
 */
class LeaveController extends AbstractController
{
    /**
     * @Route("/", name="leave_index", methods={"GET"})
     */
    public function index(LeaveRepository $leaveRepository): Response
    {
        return $this->render('leave/index.html.twig', [
            'leaves' => $leaveRepository->findAll(),
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
