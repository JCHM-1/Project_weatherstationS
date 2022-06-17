<?php

namespace App\Controller;

use App\Entity\JoinTableProfileStation;
use App\Repository\JoinTableProfileStationRepo;
use Doctrine\Persistence\ManagerRegistry;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Subscriptions;
use App\Entity\Profile;
use App\Repository\ProfileRepo;
use App\Repository\StationRepo;
use App\Repository\DataRepo;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/main/admin', name: 'admin', methods: ['GET', 'POST'])]
    public function admin(ProfileRepo $profileRepository, Request $request,JoinTableProfileStationRepo $jtpsRepo, DataRepo $dataRepo,StationRepo $stationRepo): Response
    {
        {
            $subscription = [];
            $stations = [];
            $email = 0;
            $profiles = $profileRepository->findAll();
//            var_dump($request->getMethod()==='POST');
            if ($request->getMethod()==='POST') {
                $email = $request->request->get('mail');
                $subscription = $request->request->get('sub');

                if ($profileRepository->findOneBy(array('email' => $email))) {
                    $this->addFlash('error', 'Email already exist');
                } else {
                    $this->createProfile($email, $subscription, $stations, $jtpsRepo, $dataRepo,$stationRepo);
                }
            }
            $profiles = $profileRepository->findAll();
            return $this->render('admin/profiles.html.twig', array(
                'profiles' => $profiles,
                'subscriptions' => $this->subscriptions(),
                'sub'=> $subscription
            ));

            }
    }

    public function createProfile($mail, $sub,$station,JoinTableProfileStationRepo $jtpsRepo, DataRepo $dataRepo, StationRepo $stationRepo) {
        $manager = $this->doctrine->getManager();
        $subscription = $manager->getRepository(Subscriptions::class)->findOneBy(array('id' => $sub));

        $user = new Profile();
        $user->setEmail($mail);
        $user->setSubscription($subscription);
        $manager->persist($user);
        $manager->flush();

        $this->addFlash('succes', 'Profile Added');

        $token = $this->createToken($user);
    //        var_dump($token);
            //var_dump(new JwtSecurityTokenHandler().ReadJwtToken(JWT::decode($token,$secretKey)));
        $this->addFlash('succes', 'Volgende token verstuurd naar '.$user->getEmail().' : '.$token);
        $this->generateURL('app_download', ['token' => $token]);

        return $this->redirect($this->generateUrl('admin'));
    }

    public function createToken(Profile $user) {
        $secretKey  = 'wap';
        try {
            $tokenId = [];
            array_push($tokenId, $user->getId());
        } catch (\Exception $e) {}

        // Encode the array to a JWT string.
        $token =  JWT::encode(
            $tokenId,       // Data to be encoded in the JWT
            $secretKey,  // The signing key
            'HS512'  // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );
        return $token;
    }

    #[Route('/admin/remove/{id}', name: 'remove')]
    public function removeProfile(Profile $profile, JoinTableProfileStationRepo $jtpsRepo, $id) {
        $manager = $this->doctrine->getManager();
        $stations = $jtpsRepo->findBy(['profile' => $id]);
        foreach ($stations as $station) {
            $jtps = $jtpsRepo->findOneBy(array('profile' => $profile->getId(), 'station' => $station->getStation()->getName()));
            $manager->remove($jtps);
            $manager->flush();
        }
        $manager->remove($profile);
        $manager->flush();
        $this->addFlash('succes', 'Profile Removed');
        return $this->redirect($this->generateUrl('admin'));
    }

    #[Route('/admin/edit/{id}', name: 'edit')]
    public function editProfile($id,ProfileRepo $profileRepository, JoinTableProfileStationRepo $jtpsRepo) {
        $profile = $profileRepository->findOneBy(array('id' => $id));
        $stations = $jtpsRepo->findBy(['profile' => $id]);
        $token = $stations != null ? $this->createToken($profile) : [];
        return $this->render('admin/edit.html.twig', array(
            'id' => $id,
            'profile' => $profile,
            'stations' => $stations,
            'token' => $token
        ));
    }

    #[Route('/admin/edit/{id}/{stn}', name: 'addStation')]
    public function addStation(ProfileRepo $profileRepository, JoinTableProfileStationRepo $jtpsRepo, StationRepo $stationRepo, $id, $stn) {
        $profile = $profileRepository->findOneBy(array('id' => $id));
        $stations = $jtpsRepo->findBy(['profile' => $id]);
        $exist = false;
        foreach ($stations as $station) {
            if ($station->getStation()->getName()===intval($stn)) {
                $exist = true;
            }
        }

        if ($exist) {
            $this->addFlash('error', 'Station is already in subscription.');
        } else {
            $manager = $this->doctrine->getManager();
            $jtps = new JoinTableProfileStation();
            $station = $stationRepo->findOneBy(array('name' => intval($stn)));
            $jtps->setProfile($profile);
            $jtps->setStation($station);
            $manager->persist($jtps);
            $manager->flush();

            $this->addFlash('succes', 'Station: '.$stn.' succesfully added.');
        }
        $profile = $profileRepository->findOneBy(array('id' => $id));
        $stations = $jtpsRepo->findBy(['profile' => $id]);
        $token = $stations != null ? $this->createToken($profile) : [];
        return $this->render('admin/edit.html.twig', array(
            'id' => $id,
            'profile' => $profile,
            'stations' => $stations,
            'token' => $token
        ));
    }

    #[Route('/admin/edit/remove/{id}/{stn}', name: 'removeStation')]
    public function removeStation($id, $stn, JoinTableProfileStationRepo $jtpsRepo, ProfileRepo $profileRepository, StationRepo $stationRepo) {
        $manager = $this->doctrine->getManager();
        $jtps = $jtpsRepo->findOneBy(array('profile' => $id, 'station' => $stn));
        $manager->remove($jtps);
        $manager->flush();
        $this->addFlash('succes', 'Station Removed');
        //TODO: return Url
        $profile = $profileRepository->findOneBy(array('id' => $id));
        $stations = $jtpsRepo->findBy(['profile' => $id]);
        $token = $stations != null ? $this->createToken($profile) : [];
        return $this->render('admin/edit.html.twig', array(
            'id' => $id,
            'profile' => $profile,
            'stations' => $stations,
            'token' => $token
        ));
    }

    public function subscriptions(): array {
        $subscriptions = $this->doctrine->getRepository(Subscriptions::class)->findAll();
        $subType = [];
        foreach ($subscriptions as $sub) {
            if ($sub->getId()!=999) {
                array_push($subType, $sub->getId());
            }
        }
        return $subType;
    }

}