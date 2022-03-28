<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
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

}
