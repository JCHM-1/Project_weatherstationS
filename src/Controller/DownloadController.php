<?php

namespace App\Controller;

use App\Repository\NLRepo;
use Doctrine\Common\Proxy\Exception\UnexpectedValueException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GLRepo;
use App\Repository\DataRepo;
use App\Repository\JoinTableProfileStationRepo;

class DownloadController extends AbstractController
{
    #[Route('/download/{token}', name: 'app_download')]
    public function index($token, JoinTableProfileStationRepo $jtpsRepo, DataRepo $dataRepo): Response
    {
        $key = 'wap';
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS512'));
            $id = (array)json_decode(json_encode($decoded, true));
        } catch (UnexpectedValueException $exception) {
            echo $exception->getMessage();
        }

        $weatherData = [];
        $profileStations = $jtpsRepo->findBy(['profile' => $id]);
        foreach ($profileStations as $station) {
            $stn = $station->getStation()->getName();
            $data = $dataRepo->findBy(['stn' => $stn]);
            foreach ($data as $weatherInfo) {
                $subData = [];
                $subData['stn'] = $weatherInfo->getStn();
                $subData['date'] = $weatherInfo->getDate()->format('Y-m-d');
                $subData['time'] = $weatherInfo->getTime()->format('H:i:s');
                $subData['temp'] = $weatherInfo->getTemp();
                $subData['dewp'] = $weatherInfo->getDewp();
                $subData['stp'] = $weatherInfo->getStp();
                $subData['slp'] = $weatherInfo->getSlp();
                $subData['visib'] = $weatherInfo->getVisib();
                $subData['wdsp'] = $weatherInfo->getWdsp();
                $subData['prcp'] = $weatherInfo->getFrshtt();
                $subData['sndp'] = $weatherInfo->getSndp();
                $subData['cldc'] = $weatherInfo->getCldc();
                $subData['wnddir'] = $weatherInfo->getWnddir();
                $weatherData[] = $subData;
            }
        }
        $fileContent = json_encode($weatherData);
        $response = new Response($fileContent);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    #[Route('/location/{token}', name: 'app_location')]
    public function geolocations($token, JoinTableProfileStationRepo $jtpsRepo, GLRepo $GLRepo ) {

        $key = 'wap';
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS512'));
            $id = (array)json_decode(json_encode($decoded, true));
        } catch (UnexpectedValueException $exception) {
            echo $exception->getMessage();
        }

        $locationData = [];
        $profileStations = $jtpsRepo->findBy(['profile' => $id]);
        foreach ($profileStations as $station) {
            $stn = $station->getStation()->getName();
            $stationLocation = $GLRepo->findBy(['stationName' => $stn]);
            foreach ($stationLocation as $stationInfo) {
                $subData = [];
                $subData['stn'] = $stationInfo->getStationName();
                $subData['country_code'] = $stationInfo->getCountryCode();
                $subData['island'] = $stationInfo->getIsland();
                $subData['county'] = $stationInfo->getCounty();
                $subData['place'] = $stationInfo->getPlace();
                $subData['hamlet'] = $stationInfo->getHamlet();
                $subData['town'] = $stationInfo->getTown();
                $subData['municipality'] = $stationInfo->getMunicipality();
                $subData['state_district'] = $stationInfo->getStateDistrict();
                $subData['administrative'] = $stationInfo->getAdministrative();
                $subData['state'] = $stationInfo->getState();
                $subData['village'] = $stationInfo->getVillage();
                $subData['region'] = $stationInfo->getRegion();
                $subData['province'] = $stationInfo->getProvince();
                $subData['city'] = $stationInfo->getCity();
                $subData['locality'] = $stationInfo->getLocality();
                $subData['postcode'] = $stationInfo->getPostcode();
                $subData['country'] = $stationInfo->getCountry();
                $locationData[] = $subData;
            }

        }
        $fileContent = json_encode($locationData);
        $response = new Response($fileContent);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    #[Route('/GPS/{token}', name: 'app_GPS')]
    public function GPSlocations($token, JoinTableProfileStationRepo $jtpsRepo, NLRepo $NLRepo ) {

        $key = 'wap';
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS512'));
            $id = (array)json_decode(json_encode($decoded, true));
        } catch (UnexpectedValueException $exception) {
            echo $exception->getMessage();
        }

        $GPSData = [];
        $profileStations = $jtpsRepo->findBy(['profile' => $id]);
        foreach ($profileStations as $station) {
            $stn = $station->getStation()->getName();
            $GPSLocation = $NLRepo->findBy(['stationName' => $stn]);
            foreach ($GPSLocation as $GPSInfo) {
                $subData = [];
                $subData['stn_name'] = $GPSInfo->getStationName()->getName();
                $subData['name'] = $GPSInfo->getName();
                $subData['ad_re1'] = $GPSInfo->getAdministrativeRegion1();
                $subData['ad_re2'] = $GPSInfo->getAdministrativeRegion2();
                $subData['code'] = $GPSInfo->getCountryCode()->getCountryCode();
                $subData['longitude'] = $GPSInfo->getLongitude();
                $subData['latitude'] = $GPSInfo->getLatitude();
                $GPSData[] = $subData;
            }
        }
        $fileContent = json_encode($GPSData);
        $response = new Response($fileContent);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

}
