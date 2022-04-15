<?php

namespace App\Controller;

use DateTime;
use App\Entity\Data;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/main/postdata', name: 'data')]
    public function postdata(Request $request, ManagerRegistry $doctrine): void
    {
        $entityManager = $doctrine->getManager();
        $data = $request->toArray();

        for ($x=0; $x<count($data['WEATHERDATA']); $x++) {


            $date = DateTime::createFromFormat('Y-m-d', $data['WEATHERDATA'][$x]['DATE']);
            $time = DateTime::createFromFormat('H:i:s', $data['WEATHERDATA'][$x]['TIME']);

            $input = new Data();

            $input->setStn($data['WEATHERDATA'][$x]['STN']);
            $input->setDate($date);
            $input->setTime($time);

//            if (empty($data['WEATHERDATA'][$x]['TEMP'])) {
//
//            } else {
//                $input->setTemp($data['WEATHERDATA'][$x]['TEMP']);
//            }


            $input->setTemp($data['WEATHERDATA'][$x]['TEMP']);
            $input->setDewp($data['WEATHERDATA'][$x]['DEWP']);
            $input->setStp($data['WEATHERDATA'][$x]['STP']);
            $input->setSlp($data['WEATHERDATA'][$x]['SLP']);
            $input->setVisib($data['WEATHERDATA'][$x]['VISIB']);
            $input->setWdsp($data['WEATHERDATA'][$x]['WDSP']);
            $input->setPrcp($data['WEATHERDATA'][$x]['PRCP']);
            $input->setSndp($data['WEATHERDATA'][$x]['SNDP']);
            $input->setFrshtt($data['WEATHERDATA'][$x]['FRSHTT']);
            $input->setCldc($data['WEATHERDATA'][$x]['CLDC']);
            $input->setWnddir($data['WEATHERDATA'][$x]['WNDDIR']);

            $entityManager->persist($input);
            $entityManager->flush();



//            $this->logger->log('info', '---------------------------DATA----------------------------');
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['STN']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['DATE']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['TIME']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['TEMP']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['DEWP']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['STP']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['SLP']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['VISIB']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['WDSP']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['PRCP']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['SNDP']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['FRSHTT']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['CLDC']));
//            $this->logger->log('info', gettype($data['WEATHERDATA'][$x]['WNDDIR']));
//            $this->logger->log('info', '---------------------------TYPE----------------------------');
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['STN']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['DATE']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['TIME']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['TEMP']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['DEWP']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['STP']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['SLP']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['VISIB']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['WDSP']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['PRCP']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['SNDP']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['FRSHTT']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['CLDC']));
//            $this->logger->log('info', var_dump($data['WEATHERDATA'][$x]['WNDDIR']));
        }
    }

}

