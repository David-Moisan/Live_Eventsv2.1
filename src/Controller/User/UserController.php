<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    private $repo;
    private $em;
    private $encoder;

    public function __construct(UserRepository $repo, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $this->repo = $repo;
        $this->em = $em;
        $this->encoder = $encoder;
    }

    /**
     * Create New User.
     *
     * @Route("/create-user", name="users.user.new")
     *
     * @return void
     */
    public function new(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'Votre comptre a été créé avec succès ! Bienvenue');

            return $this->redirectToRoute('product.index');
        }

        return $this->render('users/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
