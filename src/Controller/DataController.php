<?php

namespace App\Controller;

use DateTime;
use App\Entity\Data;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

            if (empty($data['WEATHERDATA'][$x]['TEMP']) || $data['WEATHERDATA'][$x]['TEMP'] == 0) {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['TEMP']) / count($data["WEATHERDATA"][$x]['TEMP'])]['TEMP']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['TEMP']);
            }

            if (empty($data['WEATHERDATA'][$x]['FRSHHT']) || $data['WEATHERDATA'][$x]['FRSHHT'] == "0" || $data['WEATHERDATA'][$x]['FRSHHT'] == "None") {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['FRSHHT']) / count($data["WEATHERDATA"][$x]['FRSHHT'])]['FRSHHT']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['FRSHHT']);
            }
//            $input->setDewp($data['WEATHERDATA'][$x]['DEWP']);
//            $input->setStp($data['WEATHERDATA'][$x]['STP']);
//            $input->setSlp($data['WEATHERDATA'][$x]['SLP']);
//            $input->setVisib($data['WEATHERDATA'][$x]['VISIB']);
//            $input->setWdsp($data['WEATHERDATA'][$x]['WDSP']);
//            $input->setPrcp($data['WEATHERDATA'][$x]['PRCP']);
//            $input->setSndp($data['WEATHERDATA'][$x]['SNDP']);
//            $input->setFrshtt($data['WEATHERDATA'][$x]['FRSHTT']);
//            $input->setCldc($data['WEATHERDATA'][$x]['CLDC']);
//            $input->setWnddir($data['WEATHERDATA'][$x]['WNDDIR']);

            $entityManager->persist($input);
            $entityManager->flush();

//            $this->logger->log('info', '---------------------------DATA----------------------------');
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['STN']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['STN']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['DATE']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['TIME']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['TEMP']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['DEWP']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['STP']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['SLP']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['VISIB']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['WDSP']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['PRCP']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['SNDP']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['FRSHTT']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['CLDC']);
//            $this->logger->log('info', $data['WEATHERDATA'][$x]['WNDDIR']);
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