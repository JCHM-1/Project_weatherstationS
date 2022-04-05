<?php

namespace App\Controller;

use App\Entity\Weatherdata;
use App\Form\WeatherDataType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManger = $entityManager;
    }

//    public function index(){
//        return $this->render(view:'weather.html.twig');
//    }

    #[Route('/postweatherdata', name: 'data')]
    public function postdata(Request $request)
    {

        $data = json_decode($request->getContent(), TRUE); //convert JSON into array


        foreach ($data as $weatherdata) {
            foreach($weatherdata as $weathersubdata) {
                echo '<pre>';
                echo $weathersubdata['STN'];
                echo '</pre>';
                $input = New Weatherdata();
                $input->setStn($weathersubdata['STN']);

                $form = $this->createForm(WeatherDataType::class, new Weatherdata());

                $form->submit($weathersubdata);
            }
    }

        if(false === $form->isValid()){
            return new JsonResponse(
                [
                    'status' => 'error',
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $this->entityManager->persist($input);
        $this->entityManager->flush();



        return new JsonResponse(
            [
                'status' => 'ok',
            ],
            JsonResponse::HTTP_CREATED
        );

//        if ($request->getMethod() === 'POST') {
//            print_r($_POST);
//            $json_string = $_POST['message'];
//            $json = json_decode($json_string);
//            print_r($json);
//            $manager = $this->doctrine->getManager();
//            $decodedRequest = json_decode($request);


//            echo '<pre>';
//            if($input)
//            var_dump($input->WEATHERDATA);
//            echo '</pre>';
//
//            $data = new WeatherData();

        // Klopt nog niet helemaal, hieronder
        // https://stackoverflow.com/questions/29308898/how-to-extract-and-access-data-from-json-with-php

        //        foreach($decodedRequest as $i) {
        //            $data->setStn($decodedRequest->WEATHERDATA[$i]->STN);
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
        //            $manager->persists($data);
        //            $manager->flush();
        //        }


//            return new Response('weatherdata posted');


//        echo '<pre>';
//        var_dump($request);
////        var_dump($request->server);
//        return $this->render('/main/retrieve.html.twig', [
//            'controller_name' => 'MainController',
//        ]);


    }

}

