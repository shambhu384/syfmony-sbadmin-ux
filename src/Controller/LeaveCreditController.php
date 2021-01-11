<?php

namespace App\Controller;

use App\Entity\LeaveCredit;
use App\Form\LeaveCreditType;
use App\Repository\LeaveCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/leave/credit")
 */
class LeaveCreditController extends AbstractController
{
    /**
     * @Route("/", name="leave_credit_index", methods={"GET"})
     */
    public function index(LeaveCreditRepository $leaveCreditRepository): Response
    {
        return $this->render('leave_credit/index.html.twig', [
            'leave_credits' => $leaveCreditRepository->findAll(),
        ]);
    }

    /**
     * @Route("/credit", name="leave_credit", methods={"GET"})
     */
    public function credit(LeaveCreditRepository $leaveCreditRepository): Response
    {
        return $this->render('leave_credit/index.html.twig', [
            'leave_credits' => $leaveCreditRepository->findBy(['user' => $this->getUser()]),
        ]);
    }

    /**
     * @Route("/new", name="leave_credit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $leaveCredit = new LeaveCredit();
        $form = $this->createForm(LeaveCreditType::class, $leaveCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($leaveCredit);
            $entityManager->flush();

            return $this->redirectToRoute('leave_credit_index');
        }

        return $this->render('leave_credit/new.html.twig', [
            'leave_credit' => $leaveCredit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="leave_credit_show", methods={"GET"})
     */
    public function show(LeaveCredit $leaveCredit): Response
    {
        return $this->render('leave_credit/show.html.twig', [
            'leave_credit' => $leaveCredit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="leave_credit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LeaveCredit $leaveCredit): Response
    {
        $form = $this->createForm(LeaveCreditType::class, $leaveCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('leave_credit_index');
        }

        return $this->render('leave_credit/edit.html.twig', [
            'leave_credit' => $leaveCredit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="leave_credit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LeaveCredit $leaveCredit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$leaveCredit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($leaveCredit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('leave_credit_index');
    }
}
