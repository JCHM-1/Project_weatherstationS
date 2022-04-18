<?php

namespace App\Controller;

use App\Repository\DataRepo;
use App\Repository\JoinTableProfileStationRepo;
use App\Repository\ProfileRepo;
use App\Repository\StationRepo;
use Firebase\JWT\JWT;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class DownloadController extends AbstractController
{
    #[Route('/download/{token}', name: 'app_download')]
    public function index($token, ProfileRepo $profileRepo, DataRepo $dataRepo, StationRepo $stationRepo, JoinTableProfileStationRepo $jtpsRepo,Request $request): void
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

            $jwt = preg_split('/ /', $_SERVER['HTTP_AUTHORIZATION'])[1];

            $decoded = JWT::decode($jwt, $key);

            var_dump($decoded);
            if (!validate($decoded)) {

                http_response_code(401);

                die;

            }

        } catch (UnexpectedValueException $exception) {

            echo $exception->getMessage();

        }

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
}
