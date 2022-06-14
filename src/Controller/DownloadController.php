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
    public function index($token, JoinTableProfileStationRepo $jtpsRepo, DataRepo $dataRepo): Response
    {
        $key = 'wap';
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS512'));
            $id = (array) json_decode(json_encode($decoded, true));
        } catch (UnexpectedValueException $exception) {
            echo $exception->getMessage();
        }

        $weatherdata = [];
        $profileStations = $jtpsRepo->findBy(['profile'=>$id]);
        foreach ($profileStations as $station) {
            $stn = $station->getStation()->getName();
            $data = $dataRepo->findBy(['stn'=>$stn]);
                foreach ($data as $weatherinfo) {
                    $subdata = [];
                    $subdata['stn'] = $weatherinfo->getStn();
                    $subdata['date'] = $weatherinfo->getDate()->format('Y-m-d');
                    $subdata['time'] = $weatherinfo->getTime()->format('H:i:s');
                    $subdata['temp'] =  $weatherinfo->getTemp();
                    $subdata['dewp'] = $weatherinfo->getDewp();
                    $subdata['stp'] = $weatherinfo->getStp();
                    $subdata['slp'] = $weatherinfo->getSlp();
                    $subdata['visib'] = $weatherinfo->getVisib();
                    $subdata['wdsp'] = $weatherinfo->getWdsp();
                    $subdata['prcp'] = $weatherinfo->getFrshtt();
                    $subdata['sndp'] = $weatherinfo->getSndp();
                    $subdata['cldc'] = $weatherinfo->getCldc();
                    $subdata['wnddir'] = $weatherinfo->getWnddir();
                    $weatherdata[] = $subdata;
                }
        }
//        $filename = 'Data.txt';

        $fileContent = json_encode($weatherdata);

        $response = new Response($fileContent);
//        $disposition = HeaderUtils::makeDisposition(
//        ResponseHeaderBag::DISPOSITION_ATTACHMENT,
//        $filename
//        );
//
//        $response->headers->set('Content-Disposition', $disposition);


            // return $this->render('download/index.html.twig', [
            //     'controller_name' => 'DownloadController',
            //     $response
            // ]);

        $response->headers->set('Access-Control-Allow-Origin', '*');

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
