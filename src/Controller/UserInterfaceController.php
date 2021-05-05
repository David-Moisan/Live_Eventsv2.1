<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserInterfaceController extends AbstractController
{
    public function __construct(UserRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    /**
     * Index.
     *
     * @Route("/boutique/mon-profil/{id}", name="user.interface.index")
     *
     * @return void
     */
    public function index(int $id): Response
    {
        $user = $this->repo->find($id);

        return $this->render('UI/index.html.twig', compact('user'));
    }

    /**==================================================================== */

    /**
     * Edit.
     *
     * @Route("/boutique/modifier-mon-profil/{id}", name="user.interface.edit", methods="GET|POST")
     *
     * @return void
     */
    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'Profil modifié avec succès');

            return $this->redirectToRoute('user.interface.index');
        }

        return $this->render('UI/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
