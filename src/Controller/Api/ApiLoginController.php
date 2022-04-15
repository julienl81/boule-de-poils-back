<?php

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Core\Security;

class ApiLoginController extends AbstractController
{
    /**
     * @Route("/api/login", name="app_api_login")
     */
    public function index (Security $security): Response
    {
        
            // return $this->json([
            //     'message' => 'Welcome to your new controller!',
            //     'path' => 'src/Controller/ApiLoginController.php',
            // ]);
        
        $user = $security->getUser();
        if (null === $user) {
            return $this->json([
                    'message' => 'missing credentials',
                     ], Response::HTTP_UNAUTHORIZED);
        }

        //$token = ...; // somehow create an API token for $user

        return $this->json([
            'user'  => $user->getUserIdentifier(),
            //'token' => $token,
        ]);
    }

    /**
     * Logout
     * 
     * @Route("/logout", name="app_api_logout")
     */
    public function logout()
    {
        // Ce code ne sera jamais exécuté
        // le composant de sécurité va intercepter la requête avant.
    }
}
  


