<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture implements FixtureGroupInterface
{
    public function __construct(private UserPasswordHasherInterface $hasher){

    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $admin= new User();
        $admin->setEmail('peterkofi74@gmail.com');
        $admin->setPassword($this->hasher->hashPassword($admin,'admin'));
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);
        $Utilisateur=['crispin','elie','josue','lord','rachel'];
        for($i=1;$i<5;$i++){
            $user=new User();
            $user->setEmail($Utilisateur[$i-1]."@gmail.com");
            $user->setPassword($this->hasher->hashPassword($user, $Utilisateur[$i-1]."K"));
            $manager->persist($user);
            $manager->flush();
        }
        

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['user'];

    }
}
