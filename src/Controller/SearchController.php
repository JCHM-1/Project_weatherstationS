<?php

namespace App\Controller;

use App\Entity\Data;
use App\Entity\Station;
use App\Entity\Geolocation;
use App\Form\WeatherdataFormType;
use App\Repository\GLrepo;
use App\Repository\StationRepo;
use App\Repository\NLrepo;
use App\Repository\DataRepository;
use App\Repository\ProfileRepository;

use Doctrine\ORM\Mapping\JoinTable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Type;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine, LoggerInterface $logger) {
        $this->logger = $logger;
    }

    #[Route('/data/search', methods:['GET', 'POST'], name: 'search')]
    public function show(Request $request, GLrepo $glrepo)
    {
        $type = null;
        $place = null;
        $output = [];
        if ($request->isMethod('POST')) {
            $type = $request->request->get('type');
            $place = $request->request->get('place');

//             $output = $this->doctrine->getRepository(Geolocation::class)->findBy([$type => $place]);
//            (Geolocation::class)->findOneBy([$type => $place]);
//             $output = $output[1];
            $output = $glrepo->findBy([$type=>$place]);
            $output = $output;


            //var_dump($output);

//            echo var_dump($type);
//            echo var_dump($place);
//            echo "<br>";
//            echo var_dump($output);
        }


//        $this->logger->log('info', '------------------------------------------------POST-------------------------------------------');
//        $this->logger->log('info', $input);
//        if ($request->get())
//        $weatherdata = [];
//        $data = new Data();
//        $form = $this->createForm(WeatherdataFormType::class, $data);

//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $weatherdata = $this->doctrine->getRepository
//            (Data::class)->findBy(array('stn'=>$data->getStn()));
//            if (!$weatherdata) {
//                $this->addFlash('error', 'Station: '.$data->getStn().' not found.');
//            }
//        }

        return $this->render('data/search.html.twig', array(
//            'data_form' => $form->createView(),
//            'weatherdata' => $weatherdata,
            'keys' => $this->getLocationKeys(),
            'stations' => $output,
            'type'=> $type,
            'place' => $place
//            'vardump' => var_dump($locations)
        ));
    }

    public function hasKey(array $output): array {
        $keys = array(
            'countryCode' => false,
            'island' => false,
            'county' => false,
            'place' => false,
            'hamlet' => false,
            'town' => false,
            'municipality' => false,
            'stateDistrict' => false,
            'administrative' => false,
            'state' => false,
            'village' => false,
            'region' => false,
            'province' => false,
            'city' => false,
            'locality' => false,
            'postcode' => false,
            'country' => false
        );

        foreach ($output as $data) {
            if (empty($data->getCountryCode())===false) {
                $keys['countryCode'] = true;
            }
            if (empty($data->getCounty())===false) {
                $keys['county'] = true;
            }
            if (empty($data->getPlace())===false) {
                $keys['place'] = true;
            }
            if (empty($data->getHamlet())===false) {
                $keys['hamlet'] = true;
            }
            if (empty($data->getTown())===false) {
                $keys['town'] = true;
            }
            if (empty($data->getMunicipality())===false) {
                $keys['municipality'] = true;
            }
            if (empty($data->getStateDistrict())===false) {
                $keys['stateDistrict'] = true;
            }
            if (empty($data->getAdministrative())===false) {
                $keys['administrative'] = true;
            }
            if (empty($data->getState())===false) {
                $keys['state'] = true;
            }
            if (empty($data->getVillage())===false) {
                $keys['village'] = true;
            }
            if (empty($data->getRegion())===false) {
                $keys['region'] = true;
            }
            if (empty($data->getProvince())===false) {
                $keys['province'] = true;
            }
            if (empty($data->getCity())===false) {
                $keys['city'] = true;
            }
            if (empty($data->getLocality())===false) {
                $keys['locality'] = true;
            }
            if (empty($data->getPostcode())===false) {
                $keys['postcode'] = true;
            }
            if (empty($data->getCountry())===false) {
                $keys['country'] = true;
            }
        }
        var_dump($keys);
        return $keys;
    }

    public function getLocationKeys(): array {
        $keyName = [];
        $locations = array_keys((array) new Geolocation);
        foreach ($locations as $key) {
            array_push($keyName, substr($key, 23));
        }
        return $keyName;
    }

    #[Route('/data/search/{stn}', name: 'showStations')]
    public function showStations($stn,StationRepo $stationRepo, NLrepo $nlrepo, GLrepo $glrepo,DataRepository $dataRepository){

        $stationdata = $stationRepo->findBy(['name'=>$stn]);
        $nearestlocdata = $nlrepo->findBy(['name'=>$stn]);
        $geolocdata = $glrepo->findBy(['stationName'=>$stn]);
        $data = $dataRepository->findBy(['stn'=>$stn]);


        return $this->render('main/show.html.twig', [
            'stationdata' => $stationdata,
            'nearestlocdata'=> $nearestlocdata,
            'geolocdata'=> $geolocdata,
            'weatherdata'=>$data

        ]);
    }

}