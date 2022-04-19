<?php

namespace App\Controller;

use Doctrine\Common\Proxy\Exception\UnexpectedValueException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use App\Repository\ProfileRepo;
use App\Repository\DataRepo;
use App\Repository\StationRepo;
use App\Repository\JoinTableProfileStationRepo;
use Symfony\Component\HttpFoundation\Request;

class DownloadController extends AbstractController
{
    #[Route('/download/{token}', name: 'app_download')]
    public function index($token, ProfileRepo $profileRepo, DataRepo $dataRepo, StationRepo $stationRepo, JoinTableProfileStationRepo $jtpsRepo,Request $request): Response
    {

//        $realtime = $profileRepo->find($token)->getSubscription()->isRealtime();
//        $stations = $jtpsRepo->findBy(['profile_id'=>$token]);
//
//        foreach($stations as $station){
//            $data = $station->findAll;
//        }
        //$jwt = $request->getBody();
        $key = 'wap';

        try {

            $decoded = JWT::decode($token, new Key($key, 'HS512'));
//            var_dump($decoded);
            $id = (array) json_decode(json_encode($decoded, true));

        } catch (UnexpectedValueException $exception) {

            echo $exception->getMessage();

        }

        $user = $profileRepo->findOneBy(['id' => $id]);
        // Retrieved from filtered POST data
        // Demo: Voor subscr 1 laat 10x data van 1 station
        if ($user->getSubscription()->getId() == 1)
        {
            $station = $jtpsRepo->findOneBy(['profile'=>$id])->getStation()->getName();
            $data = $dataRepo->findOneBy(['stn'=> $station]);

            $subdata = [];
            $weatherdata = [];

            $subdata['stn'] = $data->getStn();
//          $weatherdata['date'] = (string) $dataitem->getDate();
//          $weatherdata['time'] = (string) $dataitem->getTime();
            $subdata['temp'] = (string) $data->getTemp();
            $subdata['dewp'] = $data->getDewp();
            $subdata['stp'] = $data->getStp();
            $subdata['slp'] = $data->getSlp();
            $subdata['visib'] = $data->getVisib();
            $subdata['wdsp'] = $data->getWdsp();
            $subdata['prcp'] = $data->getFrshtt();
            $subdata['sndp'] = $data->getSndp();
            $subdata['cldc'] = $data->getCldc();
            $subdata['wnddir'] = $data->getWnddir();

            $weatherdata[] = $subdata;

        }


        // Demo: voor subscr 2 laat 1x data van 10 stations
        elseif($user->getSubscription()->getId() == 2)
        {
            $stations = $jtpsRepo->findBy(['profile'=>$id]);

            foreach($stations as $station) {
                $stn = $station->getStation()->getName();
                // Create the token as an array
                $data[] = $dataRepo->findBy(['stn'=> $stn]);
            }
        }

        // Demo: laat 100 keer data zien van 1 station
        else
        {
            $station = $jtpsRepo->findOneBy(['profile'=>$id]);
            $stn = $station->getStation()->getName();

            for($x = 100; $x>0; $x--){
                $data[] = $dataRepo->findOneBy(['stn'=> $stn]);
            }
        }

//        $weatherdata = [];
//        $subdata = [];
//
//        foreach($data as $station){
//            $subdata['stn'] = $station->getStn();
////          $weatherdata['date'] = (string) $dataitem->getDate();
////          $weatherdata['time'] = (string) $dataitem->getTime();
//            $subdata['temp'] = (string) $station->getTemp();
//            $subdata['dewp'] = $station->getDewp();
//            $subdata['stp'] = $station->getStp();
//            $subdata['slp'] = $station->getSlp();
//            $subdata['visib'] = $station->getVisib();
//            $subdata['wdsp'] = $station->getWdsp();
//            $subdata['prcp'] = $station->getFrshtt();
//            $subdata['sndp'] = $station->getSndp();
//            $subdata['cldc'] = $station->getCldc();
//            $subdata['wnddir'] = $station->getWnddir();
//
//            $weatherdata[] = $subdata;
//        }

        $filename = 'Data.txt';

        $fileContent = json_encode($weatherdata);

        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
        ResponseHeaderBag::DISPOSITION_ATTACHMENT,
        $filename
        );

        $response->headers->set('Content-Disposition', $disposition);


            // return $this->render('download/index.html.twig', [
            //     'controller_name' => 'DownloadController',
            //     $response
            // ]);

        return $response;

        // return new respone status ok

//        JWT::encode($filecontent

//        $response = new Response($fileContent);
//
//
//        $disposition = HeaderUtils::makeDisposition(
//            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
//            $filename
//        );

//        $response->headers->set('Content-Disposition', $disposition);


        // return $this->render('download/index.html.twig', [
        //     'controller_name' => 'DownloadController',
        //     $response
        // ]);

    }
//
//    public function()
//{
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//
//
//$email = '';
//$password = '';
//
//$databaseService = new DatabaseService();
//$conn = $databaseService->getConnection();
//
//
//
//$data = json_decode(file_get_contents("php://input"));
//
//}


//$filename = 'Data.txt';
//
//$fileContent = "Hello this is the content of my file";
//
//$response = new Response($fileContent);
//
//$disposition = HeaderUtils::makeDisposition(
//ResponseHeaderBag::DISPOSITION_ATTACHMENT,
//$filename
//);
//
//$response->headers->set('Content-Disposition', $disposition);
//
//
//    // return $this->render('download/index.html.twig', [
//    //     'controller_name' => 'DownloadController',
//    //     $response
//    // ]);
//
//return $response;
}
