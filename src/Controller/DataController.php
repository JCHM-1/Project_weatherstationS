<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    #[Route('/main/postdata', name: 'data')]
    public function postdata(Request $request): Response
    {

        echo '<pre>';
        var_dump($request);
//        var_dump($request->server);
        return $this->render('/main/retrieve.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}

