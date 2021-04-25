<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    private $repo;

    public function __construct(UserPasswordEncoderInterface $encoder, UserRepository $repo)
    {
        $this->encoder = $encoder;
        $this->repo = $repo;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setPassword($this->encoder->encodePassword($user, 'password'));
        $user->setEmail('davprocode@gmail.com');
        $user->setIsActive(true);
        $manager->persist($user);

        $manager->flush();
    }
}
