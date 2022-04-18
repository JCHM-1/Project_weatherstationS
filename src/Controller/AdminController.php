<?php

namespace App\Controller;

use App\Entity\JoinTableProfileStation;
use App\Repository\JoinTableProfileStationRepo;
use Doctrine\Persistence\ManagerRegistry;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Mapping\JoinTable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\Subscriptions;
use App\Entity\Profile;
use App\Repository\ProfileRepo;
use App\Entity\Data;
use App\Entity\Nearestlocation;
use App\Entity\Station;
use App\Repository\StationRepo;
use App\Repository\NLRepo;
use App\Repository\GLRepo;
use App\Repository\DataRepo;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/main/admin', methods:['GET', 'POST'], name: 'admin')]
    public function admin(ProfileRepo $profileRepository, Request $request,StationRepo $stationRepo,JoinTableProfileStationRepo $jtpsRepo, DataRepo $dataRepo): Response
    {
        {
            $subscriptions = [1, 2 ,3];
            $profiles = $profileRepository->findAll();
//            var_dump($request->getMethod()==='POST');
            if ($request->getMethod()==='POST') {
                $email = $request->request->get('mail');
                $subscription = $request->request->get('sub');

                if ($subscription == 1 or $subscription == 3) {
                    $station[] = $request->request->get('station1');
                    }
                else {
                    $station[] = $request->request->get('station1');
                    $station[] = $request->request->get('station2');
                    $station[] = $request->request->get('station3');
                    $station[] = $request->request->get('station4');
                    $station[] = $request->request->get('station5');
                    $station[] = $request->request->get('station6');
                    $station[] = $request->request->get('station7');
                    $station[] = $request->request->get('station8');
                    $station[] = $request->request->get('station9');
                    $station[] = $request->request->get('station10');
                }
                if ($profileRepository->findOneBy(array('email' => $email))) {
                    $this->addFlash('error', 'Email already exist');
                } else {
                    $this->createProfile($email, $subscription,$station[],$jtpsRepo,$dataRepo);
                }
            }

//            $stations = $stationRepo->findAll();
            $stations = [];
                return $this->render('admin/profiles.html.twig', array(
                    'profiles' => $profiles,
                    'subscriptions' => $this->subscriptions(),
                    'stations' => $stations,
                    'sub'=>$subscriptions
            ));

            }
    }

    public function createProfile($mail, $sub,$station,JoinTableProfileStationRepo $jtpsRepo, DataRepo $dataRepo) {
        $manager = $this->doctrine->getManager();
        $subscription = $manager->getRepository(Subscriptions::class)->findOneBy(array('id' => $sub));

        $user = new Profile();
        $user->setEmail($mail);
        $user->setSubscription($subscription);
        $manager->persist($user);
        $manager->flush();

        if($sub == 1 or $sub == 3){
            $jointable = new JoinTableProfileStation();
            $jointable->setProfile($user->getId());
            $jointable->setStation($station[0]);
        }else{
            for($x=0; $x<10;$x++){
                $jointable = new JoinTableProfileStation();
                $jointable->setProfile($user->getId());
                $jointable->setStation($station[$x]);
            }
        }

        $manager->persist($jointable);
        $manager->flush();

        $this->addFlash('succes', 'Profile Added');

        $secretKey  = 'wap';

        try {
            $tokenId = $user->getId();
        } catch (\Exception $e) {}


        // Retrieved from filtered POST data
        // Demo: Voor subscr 1 laat 10x data van 1 station
        if ($user->getSubscription() == 1)
        {
            $station = $jtpsRepo->findOneBy(['profile'=>$tokenId]);
            $stn = $station->getStation()->getName();

            for($x = 10; $x>0; $x--){
                $data[] = $dataRepo->findBy(['stn'=> $stn]);
            }
        }

        // Demo: voor subscr 2 laat 1x data van 10 stations
        elseif($user->getSubscription() == 2)
        {
            $stations = $jtpsRepo->findBy(['profile'=>$tokenId]);

            foreach($stations as $station) {
                $stn = $station->getStation()->getName();
                // Create the token as an array
                $data[] = $dataRepo->findBy(['stn'=> $stn]);
            }
        }

        // Demo: laat 100 keer data zien van 1 station
        else
        {
            $station = $jtpsRepo->findOneBy(['profile'=>$tokenId]);
            $stn = $station->getStation()->getName();

            for($x = 100; $x>0; $x--){
                $data[] = $dataRepo->findBy(['stn'=> $stn]);
            }
        }

        // Encode the array to a JWT string.
        $token =  JWT::encode(
            $data,       // Data to be encoded in the JWT
            $secretKey,  // The signing key
            'HS512'  // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );

        var_dump($token);
        //var_dump(new JwtSecurityTokenHandler().ReadJwtToken(JWT::decode($token,$secretKey)));
        $this->addFlash('succes', 'Volgende token verstuurd naar '.$user->getEmail().' : '.$token);
        $this->generateURL('app_download', ['token' => $token]);

        return $this->redirect($this->generateUrl('admin'));
    }

    #[Route('/admin/remove/{id}', name: 'remove')]
    public function removeProfile(Profile $profile) {
        $manager = $this->doctrine->getManager();
        $manager->remove($profile);
        $manager->flush();
        $this->addFlash('succes', 'Profile Removed');
        return $this->redirect($this->generateUrl('admin'));
    }

    #[Route('/admin/edit/{id}', name: 'edit')]
    public function editProfile($id,ProfileRepo $profileRepository, JoinTableProfileStationRepo $jtpsRepo) {
        $profile = $profileRepository->findOneBy(array('id' => $id));
        $stations = $jtpsRepo->findBy(['profile' => $id]);

        return $this->render('admin/edit.html.twig', array(
            'id' => $id,
            'profile' => $profile,
            'stations' => $stations
        ));
    }

    #[Route('/admin/edit/add/{id}', name: 'addStation')]
    public function addStation() {
    }

    #[Route('/admin/edit/remove/{id}', name: 'removeStation')]
    public function removeStation($id, JoinTableProfileStationRepo $joinTableProfileStation) {
        $manager = $this->doctrine->getManager();
        $jtps = $joinTableProfileStation->findOneBy(array('id' => $id));
        $profileId = $jtps->getProfile()->getId();
        $manager->remove($jtps);
        $manager->flush();
        $this->addFlash('succes', 'Station Removed');
        //TODO: return Url
        return $this->redirect($this->generateUrl(path('edit'), $profileId));
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