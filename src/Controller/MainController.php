<?php

namespace App\Controller;

use App\Entity\Geolocation;
use App\Entity\Profile;
use App\Entity\Data;
use App\Entity\Nearestlocation;
use App\Entity\Station;
use App\Entity\JoinTableProfileStation;
use App\Repository\JoinTableProfileStationRepo;
use App\Repository\StationRepo;
use App\Repository\NLRepo;
use App\Repository\GLRepo;
use App\Repository\DataRepo;
use App\Repository\ProfileRepo;



use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MainController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    #[Route('/main', name: 'main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/main/profile', methods:['GET'], name: 'profile')]
    public function weather(UserInterface $user, JoinTableProfileStationRepo $repo, ProfileRepo $profileRepository): Response
    {
        // $repo = $this->doctrine->getRepository("JoinTableProfileStationRepo");
        $data = $repo->findBy(['profile'=> ''.$user->getId().'' ]);
        //dd($data);

        $stations = [];
        foreach($data as $subdata){
            $stations[] = $subdata->getStation()->getName();
        }
        //dd($stations);

        $subscription = $profileRepository->find($user->getId())->getSubscription();

        $amount = $subscription->getAmount();
        //var_dump($subscription);
        $realtime = $subscription->getRealTime();




        return $this->render('main/profile.html.twig', array
        ('stations' => $stations,
        'amount'=>$amount,
        'realtime'=>$realtime
        ));
    }

    #[Route('/main/locations', methods:['GET'], name: 'locations')]
    public function locations(): Response
    {
        $geolocations = $this->doctrine->getRepository
        (Geolocation::class)->findBy(
            array(),
            array('id' => 'ASC'),
            100,
            0
        );
        return $this->render('main/locations.html.twig', array
        ('geolocations' => $geolocations));
    }

    #[Route('/main/profile/station/{stn}', name: 'show')]
    public function show($stn, StationRepo $stationRepo, NLRepo $nlrepo, GLRepo $glrepo, DataRepo $dataRepository){

        $stationdata = $stationRepo->find($stn);
        $nearestlocdata = $nlrepo->find($stn);
        $geolocdata = $glrepo->find($stn);
        $data = $dataRepository->findBy(['stn'=>$stn]);

        var_dump($data);


        return $this->render('main/show.html.twig', [
            'stationdata' => $stationdata,
            'nearestlocdata'=> $nearestlocdata,
            'geolocdata'=> $geolocdata,
            'weatherdata'=>$data

        ]);
    }

}
