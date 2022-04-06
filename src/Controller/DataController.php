<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
{

    private LoggerInterface $logger;

    public function __construct(private ManagerRegistry $doctrine, LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/main/postdata', name: 'data')]
    public function postdata(Request $request): Response
    {
        $data = $request->toArray();
        echo '<pre>';
        //find data in var/log/dev.log
        for ($x=0; $x<count($data['WEATHERDATA']); $x++) {
//            var_dump($data['WEATHERDATA'][$x]['STN']);
//            var_dump($data['WEATHERDATA'][$x]['DATE']);
//            var_dump($data['WEATHERDATA'][$x]['TIME']);
//            var_dump($data['WEATHERDATA'][$x]['TEMP']);
//            var_dump($data['WEATHERDATA'][$x]['DEWP']);
//            var_dump($data['WEATHERDATA'][$x]['STP']);
//            var_dump($data['WEATHERDATA'][$x]['SLP']);
//            var_dump($data['WEATHERDATA'][$x]['VISIB']);
//            var_dump($data['WEATHERDATA'][$x]['WDSP']);
//            var_dump($data['WEATHERDATA'][$x]['PRCP']);
//            var_dump($data['WEATHERDATA'][$x]['SNDP']);
//            var_dump($data['WEATHERDATA'][$x]['FRSHTT']);
//            var_dump($data['WEATHERDATA'][$x]['CLDC']);
//            var_dump($data['WEATHERDATA'][$x]['WNDDIR']);
            $this->logger->log('info', '---------------------------DATA----------------------------');
            $this->logger->log('info', $data['WEATHERDATA'][$x]['STN']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['DATE']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['TIME']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['TEMP']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['DEWP']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['STP']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['SLP']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['VISIB']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['WDSP']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['PRCP']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['SNDP']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['FRSHTT']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['CLDC']);
            $this->logger->log('info', $data['WEATHERDATA'][$x]['WNDDIR']);
        }

//        var_dump($request->server);
        return $this->render('/main/retrieve.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}

