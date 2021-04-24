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

    /**======================================================== */

    /**
     * Index.
     *
     * @Route("/admin/programme/index", name="admin.program.index")
     *
     * @return void
     */
    public function index()
    {
        $program = $this->repo->findAll();

        return $this->render('/admin/program/index.html.twig', compact('program'));
    }

    /**======================================================== */

    /**
     * Edit.
     *
     * @Route("/admin/programme/{id}", name="admin.program.edit", methods="GET|POST")
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

    /**======================================================== */

    /**
     * New.
     *
     * @Route("/admin/creation/programme", name="admin.program.new")
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
            $this->addFlash('success', 'Programme créé avec succès !');

            return $this->redirectToRoute('admin.program.index');
        }

        return $this->render('/admin/program/new.html.twig', [
            'program' => $program,
            'form' => $form->createView(),
        ]);
    }

    /**======================================================== */

    /**
     * Delete.
     *
     * @Route("/admin/programme/{id}", name="admin.program.delete", methods="DELETE")
     *
     * @return void
     */
    public function delete(Program $program, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$program->getId(), $request->get('_token'))) {
            $this->em->remove($program);
            $this->em->flush();
            $this->addFlash('success', 'Programme suppirmé avec succès');
        }

        return $this->redirectToRoute('admin.program.index');
    }
}
