<?php

namespace App\Controller;

use App\Entity\Geolocation;
use App\Entity\Profile;
use App\Entity\Data;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/', name: 'home')]
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

    #[Route('/main/weather', methods:['GET'], name: 'weather')]
    public function weather(): Response
    {
        $weatherdata = $this->doctrine->getRepository
        (Data::class)->findAll();
        return $this->render('main/weather.html.twig', array
        ('weatherdata' => $weatherdata));
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
