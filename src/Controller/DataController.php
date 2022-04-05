<?php

namespace App\Controller;

use App\Entity\Weatherdata;
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

    public function index(){
        return $this->render(view:'weather.html.twig');
    }

    #[Route('/postweatherdata', name: 'data')]
    public function postdata(Request $request): Response
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $manager = $this->doctrine->getManager();
            $decodedRequest = json_decode($request);

            echo '<pre>';
            var_dump($request);
            echo '</pre>';

            $data = new WeatherData();


            // Klopt nog niet helemaal, hieronder
            // https://stackoverflow.com/questions/29308898/how-to-extract-and-access-data-from-json-with-php

            //        foreach($decodedRequest as $i) {
            //            $data->setStn($decodedRequest->WEATHERDATA[$i]->DATE);
            //            $data->setDate($decodedRequest->WEATHERDATA[$i]->DATE);
            //            $data->setTime($decodedRequest->WEATHERDATA[$i]->TIME);
            //            $data->setTemp($decodedRequest->WEATHERDATA[$i]->TEMP);
            //            $data->setDewp($decodedRequest->WEATHERDATA[$i]->DEWP);
            //            $data->setStp($decodedRequest->WEATHERDATA[$i]->STP);
            //            $data->setSlp($decodedRequest->WEATHERDATA[$i]->SLP);
            //            $data->setVisib($decodedRequest->WEATHERDATA[$i]->VISB);
            //            $data->setWdsp($decodedRequest->WEATHERDATA[$i]->WDSP);
            //            $data->setPrcp($decodedRequest->WEATHERDATA[$i]->PRCP);
            //            $data->setSndp($decodedRequest->WEATHERDATA[$i]->SNDP);
            //            $data->setFrshtt($decodedRequest->WEATHERDATA[$i]->FRSHTT);
            //            $data->setCldc($decodedRequest->WEATHERDATA[$i]->CLDC);
            //            $data->setWnddir($decodedRequest->WEATHERDATA[$i]->WNDDIR);
            //
            //
            //            $manager->persists($data);
            //            $manager->flush();
            //        }


            return new Response('weatherdata posted');


//        echo '<pre>';
//        var_dump($request);
////        var_dump($request->server);
//        return $this->render('/main/retrieve.html.twig', [
//            'controller_name' => 'MainController',
//        ]);

        }
        return new Response('no weatherdata posted/');
    }
}

