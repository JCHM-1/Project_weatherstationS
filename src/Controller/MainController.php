<?php

namespace App\Controller;

use App\Entity\Geolocation;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/main/weather', methods:['GET'], name: 'app_weather')]
    public function weather(): Response
    {
        return $this->render('main/weather.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/main/admin', methods:['GET'], name: 'app_admin')]
    public function admin(): Response
    {
        return $this->render('main/admin.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/main/locations', methods:['GET'], name: 'app_locations')]
    public function locations(): Response
    {
        $geolocations = $this->doctrine->getRepository
        (Geolocation::class)->findAll();
        return $this->render('main/locations.html.twig', array
        ('geolocations' => $geolocations));
    }

}
