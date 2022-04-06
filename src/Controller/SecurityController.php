<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


// Of VoterInterface, of UserInterface + UserProviderInterface
//
//
class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login'),]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //    if($this->getRoles() == ['ROLE_USER']{
        //          return $this->redirectToRoute('target_path');
        //     }
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
//        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    // Dit toepassen, miss ...
    // https://www.php-fig.org/psr/psr-3/
    /*
    public function week6()
    {

        $request = Request::create

        require_once 'vendor/autoload.php';

        $factory = new PasswordHasherFactory([
            'old' => ['algorithm' => 'pbkdf2'],
            'default' => ['algorithm' => 'auto']
        ]);

        $old_hasher = $factory->getPasswordHasher('old');
        $hash = $old_hasher->hash('test');
        $hasher = $factory->getPasswordHasher('default');
        var_dump($hash, $hasher->verify($hash,'test'));
        var_dump($hasher);
    */

//        if($use_cookie){
//            if(isset($_GET['password'])){
//
//            }
//        }


}
