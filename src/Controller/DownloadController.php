<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class DownloadController extends AbstractController
{
    #[Route('/download{token}', name: 'app_download')]
    public function index(): Response
    {
        
        $filename = 'Data.txt';

        $fileContent = "Hello this is the content of my file";

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

    }
}
