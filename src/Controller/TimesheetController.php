<?php

namespace App\Controller;

use App\Entity\Timesheet;
use App\Form\TimesheetType;
use App\Repository\TimesheetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/timesheet")
 */
class TimesheetController extends AbstractController
{
    /**
     * @Route("/", name="timesheet_index", methods={"GET"})
     */
    public function index(TimesheetRepository $timesheetRepository): Response
    {
        return $this->render('timesheet/index.html.twig', [
            'timesheets' => $timesheetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="timesheet_new", methods={"GET","POST"})
     */
    public function new(Request $request, TimesheetRepository $timesheetRepository): Response
    {
        $timesheet = new Timesheet();
        $form = $this->createForm(TimesheetType::class, $timesheet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $timesheet->setCreatedAt(new \DateTime('now'));
            $entityManager->persist($timesheet);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('timesheet_new');
        }

        return $this->render('timesheet/new.html.twig', [
            'timesheet' => $timesheet,
            'form' => $form->createView(),
            'timesheets' => $timesheetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="timesheet_show", methods={"GET"})
     */
    public function show(Timesheet $timesheet): Response
    {
        return $this->render('timesheet/show.html.twig', [
            'timesheet' => $timesheet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="timesheet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Timesheet $timesheet): Response
    {
        $form = $this->createForm(TimesheetType::class, $timesheet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('timesheet_index');
        }

        return $this->render('timesheet/edit.html.twig', [
            'timesheet' => $timesheet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timesheet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Timesheet $timesheet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timesheet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($timesheet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('timesheet_index');
    }
}
