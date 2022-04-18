<?php

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ApiLoginController extends AbstractController
{
    /**
     * Display login form and process login form (GET + POST)
     * @Route("/login", name="app_api_login")
     * //@Route("/login", name="login_index")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // Les deux lignes suivantes servent en cas d'échec à la connexion
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        dump($authenticationUtils);
    
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
    // login/index.html.twig'
    //http://localhost:8080/login

    // /**
    //  * Logout
    //  * 
    //  * @Route("/logout", name="login_logout")
    //  */
    // public function logout()
    // {
    //     //throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    // }
}




// /**
//  * @Route("/api/login", name="app_api_login")
//  */
// public function index (Security $security): Response
// {
    
//         // return $this->json([
//         //     'message' => 'Welcome to your new controller!',
//         //     'path' => 'src/Controller/ApiLoginController.php',
//         // ]);
//     dump($security);
//     $user = $security->getUser();
//     if (null === $user) {
//         return $this->json([
//                 'message' => 'missing credentials',
//                  ], Response::HTTP_UNAUTHORIZED);
//     }

//     //$token = ...; // somehow create an API token for $user

//     return $this->json([
//         'user'  => $user->getUserIdentifier(),
//         //'token' => $token,
//     ]);
// }

// /**
//  * Logout
//  * 
//  * @Route("/logout", name="app_api_logout")
//  */
// public function logout()
// {
//     // Ce code ne sera jamais exécuté
//     // le composant de sécurité va intercepter la requête avant.
// }