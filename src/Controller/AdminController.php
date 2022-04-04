<?php

namespace App\Controller;

use App\Entity\Profile;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/admin/remove/{id}', name: 'remove')]
    public function removeProfile(Profile $profile) {
        $manager = $this->doctrine->getManager();
        $manager->remove($profile);
        $manager->flush();
        $this->addFlash('succes', 'Profile Removed');
        return $this->redirect($this->generateUrl('profiles'));
    }

}