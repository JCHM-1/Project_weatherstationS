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
use App\Repository\NLrepo;
use App\Repository\GLrepo;
use App\Repository\DataRepository;
use App\Repository\ProfileRepository;

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



    #[Route('/main/locations', methods:['GET'], name: 'locations')]
    public function locations(): Response
    {
        $geolocations = $this->doctrine->getRepository
        (Geolocation::class)->findAll();
        return $this->render('main/locations.html.twig', array
        ('geolocations' => $geolocations));
    }

}
