<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Mapping\JoinTable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\Subscriptions;
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

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/main/admin', methods:['GET', 'POST'], name: 'admin')]
    public function admin(ProfileRepository $profileRepository, Request $request): Response
    {
        {

            $profiles = $profileRepository->findAll();
//            var_dump($request->getMethod()==='POST');
            if ($request->getMethod()==='POST') {
                $email = $request->request->get('mail');
                $subscription = $request->request->get('sub');
                if ($profileRepository->findOneBy(array('email' => $email))) {
                    $this->addFlash('error', 'Email already exist');
                } else {
                    $this->createProfile($email, $subscription);
                }
            }

                return $this->render('admin/profiles.html.twig', array
                ('profiles' => $profiles,
                'subscriptions' => $this->subscriptions()
            ));
            }
    }

    public function createProfile($mail, $sub) {
        $manager = $this->doctrine->getManager();

        $subscription = new Subscriptions();
        if ($sub === '2') {
            $subscription->setAmount(10);
        } else {
            $subscription->setAmount(1);
        }
        $realtime = $sub === '1' or '2';
        $subscription->setRealtime($realtime);
        $manager->persist($subscription);
        $manager->flush();

        $user = new Profile();
        $user->setEmail($mail);
        $user->setSubscription($subscription);
        $manager->persist($user);
        $manager->flush();
        $this->addFlash('succes', 'Profile Added');
    }

    #[Route('/admin/remove/{id}', name: 'remove')]
    public function removeProfile(Profile $profile) {
        $manager = $this->doctrine->getManager();
        $manager->remove($profile);
        $manager->flush();
        $this->addFlash('succes', 'Profile Removed');
        return $this->redirect($this->generateUrl('admin'));
    }

    #[Route('/admin/edit', name: 'edit')]
    public function editProfile(ProfileRepository $profileRepository) {
//        $profile = $profileRepository->findOneBy(array('id' => 2));
//        var_dump($profile->getEmail());


        return $this->render('admin/edit.html.twig', array(
            'profile' => $profile
        ));
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