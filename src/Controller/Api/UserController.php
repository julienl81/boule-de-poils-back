<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Response\JsonErrorResponse;
use Doctrine\Persistence\ManagerRegistry;
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
    * @Route("", name="create", methods={"POST"})
    * @return Response
    */
    public function create(ManagerRegistry $doctrine, Request $request, UserRepository $userRepository, UserPasswordHasherInterface $hasher, SerializerInterface $serializer): Response
    {
        if (! $this->isGranted("ROLE_ADMIN"))
        {
            $data = 
            [
                'error' => true,
                'msg' => 'Il faut être admin pour accéder à ce endpoint ( You SHALL not PASS )'
            ];
            return $this->json($data, Response::HTTP_FORBIDDEN);
        }
        // récupérer les données depuis la requete
        $userAsJson = $request->getContent();

        /** @var User $user */
        $user = $serializer->deserialize($userAsJson, User::class, JsonEncoder::FORMAT);

        $hashedPassword = $hasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);

        // enregistrer le user en BDD
        $entityManager = $doctrine->getManager();

        $entityManager->persist($user);

        $entityManager->flush();

        $data = [
            'id' => $user->getId(),
        ];


        return $this->json($data, Response::HTTP_CREATED);



        // $user = new User();
        // $form = $this->createForm(UserType::class, $user);
        // $form->submit(json_decode($request->getContent(), true));

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
        //     $em->persist($user);
        //     $em->flush();

        //     return $this->json($user, 201, [], ['groups' => 'user:read']);
        // }

        // return $this->json($form->getErrors(), 400);
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