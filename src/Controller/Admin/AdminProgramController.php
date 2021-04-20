<?php

namespace App\Controller\Admin;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminProgramController extends AbstractController
{
    private $repo;
    private $em;

    public function __construct(ProgramRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    /* ============================================================== */

    /**
     * Index.
     *
     * @Route("/admin/program/index", name="admin.program.index")
     *
     * @return void
     */
    public function index()
    {
        $programs = $this->repo->findAll();

        return $this->render('admin/program/index.html.twig', compact('programs'));
    }

    /* ============================================================== */

    /**
     * Edit.
     *
     * @Route("/admin/program/edit/{id}", name="admin.program.edit", methods="GET|POST")
     *
     * @return void
     */
    public function edit(Program $program, Request $request)
    {
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($program);
            $this->em->flush();
            $this->addFlash('success', 'Programme modifié avec succès');

            return $this->redirectToRoute('admin.program.index');
        }

        return $this->render('admin/program/edit.html.twig', [
            'program' => $program,
            'form' => $form->createView(),
        ]);
    }

    /* ============================================================== */

    /**
     * Create new .
     *
     * @Route("/admin/program/creation", name="admin.program.new")
     *
     * @return void
     */
    public function new(Request $request)
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($program);
            $this->em->flush();
            $this->addFlash('success', 'Programme créé avec succès');

            return $this->redirectToRoute('admin.program.index');
        }

        return $this->render('admin/program/new.html.twig', [
            'program' => $program,
            'form' => $form->createView(),
        ]);
    }

    /* ============================================================== */

    /**
     * Delete a program.
     *
     * @Route("/admin/program/delete/{id}", name="admin.program.delete", methods="DELETE")
     *
     * @return void
     */
    public function delete(Program $program, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$program->getId(), $request->get('_token'))) {
            $this->em->remove($program);
            $this->em->flush();
            $this->addFlash('success', 'Programme supprimé avec succès');
        }

        return $this->redirectToRoute('admin.program.index');
    }
}
