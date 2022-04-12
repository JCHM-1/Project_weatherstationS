<?php

namespace App\Controller;

use App\Entity\Data;
use App\Form\WeatherdataFormType;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/main/search', methods:['GET', 'POST'], name: 'search')]
    public function show(Environment $twig, Request $request)
    {
        $weatherdata = [];
        $data = new Data();
        $form = $this->createForm(WeatherdataFormType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weatherdata = $this->doctrine->getRepository
            (Data::class)->findBy(array('stn'=>$data->getStn()));
//            var_dump($weatherdata);
            if (!$weatherdata) {
                $this->addFlash('error', 'Station: '.$data->getStn().' not found.');
            }
        }

        return $this->render('data/search.html.twig', array(
            'data_form' => $form->createView(),
            'weatherdata' => $weatherdata
        ));
    }

}