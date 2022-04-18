<?php

namespace App\Controller;

use DateTime;
use App\Entity\Data;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DataController extends AbstractController
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/main/postdata', name: 'data')]
    public function postdata(Request $request, ManagerRegistry $doctrine): JsonResponse
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
            if (empty($data['WEATHERDATA'][$x]['DEWP']) || $data['WEATHERDATA'][$x]['DEWP'] == 0) {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['DEWP']) / count($data["WEATHERDATA"][$x]['DEWP'])]['DEWP']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['DEWP']);
            }
            if (empty($data['WEATHERDATA'][$x]['STP']) || $data['WEATHERDATA'][$x]['STP'] == 0) {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['STP']) / count($data["WEATHERDATA"][$x]['STP'])]['STP']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['STP']);
            }
            if (empty($data['WEATHERDATA'][$x]['SLP']) || $data['WEATHERDATA'][$x]['SLP'] == 0) {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['SLP']) / count($data["WEATHERDATA"][$x]['SLP'])]['SLP']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['SLP']);
            }
            if (empty($data['WEATHERDATA'][$x]['VISIB']) || $data['WEATHERDATA'][$x]['VISIB'] == 0) {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['VISIB']) / count($data["WEATHERDATA"][$x]['VISIB'])]['VISIB']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['VISIB']);
            }
            if (empty($data['WEATHERDATA'][$x]['WDPSP'])|| $data['WEATHERDATA'][$x]['DWSP'] == 0) {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['WDSP']) / count($data["WEATHERDATA"][$x]['WDSP'])]['WDSP']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['WDSP']);
            }
            if (empty($data['WEATHERDATA'][$x]['PRCP']) || $data['WEATHERDATA'][$x]['PRCP'] == 0) {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['PRCP']) / count($data["WEATHERDATA"][$x]['PRCP'])]['PRCP']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['PRCP']);
            }
            if (empty($data['WEATHERDATA'][$x]['SNDP']) || $data['WEATHERDATA'][$x]['SNDP'] == 0) {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['SNDP']) / count($data["WEATHERDATA"][$x]['SNDP'])]['SNDP']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['SNDP']);
            }
            if (empty($data['WEATHERDATA'][$x]['FRSHHT']) || $data['WEATHERDATA'][$x]['FRSHHT'] == "0" || $data['WEATHERDATA'][$x]['FRSHHT'] == "None") {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['FRSHHT']) / count($data["WEATHERDATA"][$x]['FRSHHT'])]['FRSHHT']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['FRSHHT']);
            }
            if (empty($data['WEATHERDATA'][$x]['CLDC']) || $data['WEATHERDATA'][$x]['CLDC'] == 0) {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['CLDC']) / count($data["WEATHERDATA"][$x]['CLDC'])]['CLDC']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['CLDC']);
            }
            if (empty($data['WEATHERDATA'][$x]['WNDDIR']) || $data['WEATHERDATA'][$x]['WNDDIR'] == 0 ) {
                $input->setTemp($data['WEATHERDATA'][
                array_sum($data["WEATHERDATA"][$x]['WNDDIR']) / count($data["WEATHERDATA"][$x]['WNDDIR'])]['WNDDIR']);
            } else {
                $input->setTemp($data['WEATHERDATA'][$x]['WNDDIR']);
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

            $this->logger->log('info', '---------------------------DATA----------------------------');
            $this->logger->log('info', $data['WEATHERDATA'][$x]['STN']);
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
            return new JsonResponse(
            [
                'status' => 'ok',
            ],
            JsonResponse::HTTP_CREATED
        );

        }

    }

}