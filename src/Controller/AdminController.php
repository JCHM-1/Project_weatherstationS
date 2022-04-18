<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Mapping\JoinTable;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Entity\Subscriptions;
use App\Entity\Geolocation;
use App\Entity\Profile;
use App\Entity\Data;
use App\Entity\Nearestlocation;
use App\Entity\Station;
use App\Entity\JoinTableProfileStation;
use App\Repository\JoinTableProfileStationRepo;
use App\Repository\StationRepo;
use App\Repository\NLRepo;
use App\Repository\GLRepo;
use App\Repository\DataRepo;
use App\Repository\ProfileRepo;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/main/admin', methods:['GET', 'POST'], name: 'admin')]
    public function admin(ProfileRepo $profileRepository, Request $request): Response
    {
        {

            $profiles = $profileRepository->findAll();
//            var_dump($request->getMethod()==='POST');
            if ($request->getMethod()==='POST') {
                $email = $request->request->get('mail');
                $subscription = $request->request->get('sub');
                if ($profileRepository->findOneBy(array('email' => $email))) {
                    $this->addFlash('error', 'Email already exist');
                } else {
                    $this->createProfile($email, $subscription);
                }
            }

                return $this->render('admin/profiles.html.twig', array(
                    'profiles' => $profiles,
                'subscriptions' => $this->subscriptions()
                ));
            }
    }

    public function createProfile($mail, $sub) {
        $manager = $this->doctrine->getManager();

        $subscription = $manager->getRepository(Subscriptions::class)->findOneBy(['id'=>$sub]);

        $user = new Profile();
        $user->setEmail($mail);
        $user->setSubscription($subscription);
        $manager->persist($user);
        $manager->flush();
        $this->addFlash('succes', 'Profile Added');

        $secretKey  = 'wap';
        try {
            $tokenId = $user->getId();
        } catch (\Exception $e) {
        }
        // Retrieved from filtered POST data

        // Create the token as an array
        $data = [
            // Json Token Id: an unique identifier for the token
            'jti'  => $tokenId
        ];

        // Encode the array to a JWT string.
        $token =  JWT::encode(
            $data,       // Data to be encoded in the JWT
            $secretKey,  // The signing key
            'HS512'  // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );

        var_dump($token);
        //var_dump(new JwtSecurityTokenHandler().ReadJwtToken(JWT::decode($token,$secretKey)));
        $this->addFlash('succes', 'Volgende token verstuurd naar '.$user->getEmail().' : '.$token);
        $this->generateURL('app_download', ['token' => $token]);

    }



    #[Route('/admin/remove/{id}', name: 'remove')]
    public function removeProfile(Profile $profile) {
        $manager = $this->doctrine->getManager();
        $manager->remove($profile);
        $manager->flush();
        $this->addFlash('succes', 'Profile Removed');
        return $this->redirect($this->generateUrl('admin'));
    }

    #[Route('/admin/edit/{id}', name: 'edit')]
    public function editProfile($id,ProfileRepo $profileRepository, JoinTableProfileStationRepo $jtpsRepo) {
        $profile = $profileRepository->findOneBy(array('id' => $id));
//        var_dump($profile->getEmail());
        $stations = $jtpsRepo->findBy(['profile' => $id]);

        foreach($stations as $station) {
            var_dump($station->getStation()->getName());
        }

        $key[] = 'wap';
        $jwt = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJqdGkiOiI1eWRkdXJvSHB1eVE5VlkxUTlWSUJ3PT0ifQ.JssGBy3-Toa34LqG5aBALEd5jsV-ehLmzjkTAIQX-LwZ9Gmv40CCM5Xc65S-fwquMJq4XArifzFF9V-e9jx3eQ';
        $decoded = JWT::decode($jwt, $key);

        echo $decoded;

        return $this->render('admin/edit.html.twig', array(
            'id' => $id,
            'profile' => $profile,
            'stations' => $stations
        ));
    }

    public function subscriptions(): array {
        $subscriptions = array (
            '1' => 1,
            '2' => 2,
            '3' => 3
        );
        return $subscriptions;
    }

}

