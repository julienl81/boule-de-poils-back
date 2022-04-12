<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Response\JsonErrorResponse;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
* @Route("/api/users", name="app_api_users")
*/
class UserController extends AbstractController
{
    /**
    * Creates a new user
    * @Route("", name="create", methods={"GET"})
    * @return Response
    */
    public function create(ManagerRegistry $doctrine, Request $request, UserRepository $userRepository, UserPasswordHasherInterface $hasher, ValidatorInterface $validator, SerializerInterface $serializer): Response
    {
        // if (! $this->isGranted("ROLE_ADMIN"))
        // {
        //     $data = 
        //     [
        //         'error' => true,
        //         'msg' => 'Il faut être admin pour accéder à ceci'
        //     ];
        //     return $this->json($data, Response::HTTP_FORBIDDEN);
        // }
        // // récupérer les données depuis la requete
        // $userAsJson = $request->getContent();

        // /** @var User $user */
        // $user = $serializer->deserialize($userAsJson, User::class, JsonEncoder::FORMAT);

        /**
         * @link https://stackoverflow.com/questions/19605150/regex-for-password-must-contain-at-least-eight-characters-at-least-one-number-a
         */

        // $hashedPassword = $hasher->hashPassword($user, $user->getPassword());
        // $user->setPassword($hashedPassword);

        // // enregistrer le user en BDD
        // $entityManager = $doctrine->getManager();

        // $entityManager->persist($user);

        // $entityManager->flush();

        // $data = [
        //     'id' => $user->getId(),
        // ];

        // return $this->json($data, Response::HTTP_CREATED);



        // Récupérer le contenu JSON
        $jsonContent = $request->getContent();

        $parsed_json = json_decode($jsonContent);
        dump($parsed_json);

        // Mettre les critères du Json en variables php
        $username = $parsed_json->username;   
        $email = $parsed_json->email; 
        $password = $parsed_json->password;    
            
        // Créer un nouvel utilisateur
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);

        // Enregistrer l'utilisateur en BDD
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();


        // Retourner le nouvel utilisateur
        return $this->json($user, 201, [], ['groups' => 'api_user']);
    

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->submit($request->request->all());
            
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            return $this->json($user, 201, [], ['groups' => 'api_user']);
        }
    }

    /**
    * Get a user details
    * 
    * @Route("/{id}", name="read", methods="GET", requirements={"id"="\d+"})
    * @return Response
    */
    public function read(int $id, UserRepository $userRepository): Response
    {
        // préparer les données
        $user = $userRepository->find($id);

        if (is_null($user))
        {
            $data = 
            [
                'error' => true,
                'message' => 'User not found',
            ];
            return $this->json($data, Response::HTTP_NOT_FOUND, [], ['groups' => "api_user"]);
        }

        return $this->json($user, Response::HTTP_OK, [], ['groups' => "api_user"]);
    }

}