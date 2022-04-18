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
            $content = (array) json_decode(json_encode($decoded, true));

            echo '<pre>';
            var_dump($decoded);
            echo '</pre>';

        } catch (UnexpectedValueException $exception) {

            echo $exception->getMessage();

        }

        $filename = 'Data.txt';

        $fileContent = implode(" ", $content);

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
