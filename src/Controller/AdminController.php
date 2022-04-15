<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Mapping\JoinTable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\Geolocation;
use App\Entity\Profile;
use App\Entity\Data;
use App\Entity\Nearestlocation;
use App\Entity\Station;
use App\Entity\JoinTableProfileStation;
use App\Repository\JoinTableProfileStationRepo;
use App\Repository\StationRepo;
use App\Repository\NLrepo;
use App\Repository\GLrepo;
use App\Repository\DataRepository;
use App\Repository\ProfileRepository;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{

    #[Route('/main/admin', methods:['GET'], name: 'admin')]
    public function admin(UserInterface $user, JoinTableProfileStationRepo $repo,ProfileRepository $profileRepository): Response
    {
        {
                $profiles = $profileRepository->findAll();
                return $this->render('admin/profiles.html.twig', array
                ('profiles' => $profiles,
                'subscriptions' => $this->subscriptions(),
            ));
            }
    }


    #[Route('/main/admin/add', methods:['POST','GET'], name: 'add')]
    public function add(Request $request): Response
    {
        {
                $email = $request->request->get('mail');
                $subscription = $request->request->get('sub');
                var_dump($email);
                var_dump($subscription);
                return new Response;
            
            }
    }

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/admin/remove/{id}', name: 'remove')]
    public function removeProfile(Profile $profile) {
        $manager = $this->doctrine->getManager();
        $manager->remove($profile);
        $manager->flush();
        $this->addFlash('succes', 'Profile Removed');
        return $this->redirect($this->generateUrl('admin'));
    }

    public function subscriptions(): array {
        $subscriptions = array (
            '1' => 1,
            '2' => 2,
            '3' => 3
        );
        return $subscriptions;
    }

}