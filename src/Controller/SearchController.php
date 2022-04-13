<?php

namespace App\Controller;

use App\Entity\Data;
use App\Entity\Station;
use App\Entity\Geolocation;
use App\Form\WeatherdataFormType;

use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Type;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine, LoggerInterface $logger) {
        $this->logger = $logger;
    }

    #[Route('/data/search', methods:['GET', 'POST'], name: 'search')]
    public function show(Request $request)
    {
        $output = [];
        $station = new Station;
        if ($request->isMethod('POST')) {
            $type = $request->request->get('type');
            $place = $request->request->get('place');
            $output = $this->doctrine->getRepository
            (Geolocation::class)->findBy([$type => $place]);
        }


//        $this->logger->log('info', '------------------------------------------------POST-------------------------------------------');
//        $this->logger->log('info', $input);

        return $this->render('data/search.html.twig', array(
//            'data_form' => $form->createView(),
//            'weatherdata' => $weatherdata,
            'keys' => $this->getLocationKeys(),
            'stations' => $output
//            'vardump' => var_dump($locations)
        ));
    }

    public function getLocationKeys(): array {
        $keyName = [];
        $locations = array_keys((array) new Geolocation);
        foreach ($locations as $key) {
            array_push($keyName, substr($key, 23));
        }
        return $keyName;
    }

}