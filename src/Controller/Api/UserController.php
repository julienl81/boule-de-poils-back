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
* @Route("/api/user/form", name="app_api_user")
*/
class UserController extends AbstractController
{
    /**
    * Creates a new user
    * @Route("", name="create", methods="POST")
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

        // récupérer les données depuis la requete
        $userAsJson = $request->getContent();

        /** @var User $user */
        $user = $serializer->deserialize($userAsJson, User::class, JsonEncoder::FORMAT);

        /**
         * @link https://stackoverflow.com/questions/19605150/regex-for-password-must-contain-at-least-eight-characters-at-least-one-number-a
         */

        $hashedPassword = $hasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);
        $user->setRoles(["ROLE_USER"]);
        $user->setActive("active");



        // enregistrer le user en BDD
        $entityManager = $doctrine->getManager();

        $entityManager->persist($user);

        $entityManager->flush();

        $data = [
            'id' => $user->getId(),
        ];

        return $this->json($data, Response::HTTP_CREATED);
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


    /**
     * Updates a user
     * 
     * @Route("/{id}", name="update", methods="PUT", requirements={"id"="\d+"})
     * @return Response
     */
    public function update(ValidatorInterface $validator, int $id, ManagerRegistry $doctrine,  UserPasswordHasherInterface $hasher, Request $request, UserRepository $userRepository, SerializerInterface $serializer): Response
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

        // récupérer l'utilisateur dans la BDD
        $user = $userRepository->find($id);

        // gérer le cas ou l'id n'existe pas en BDD
        if (is_null($user))
        {
            return JsonErrorResponse::sendError('Cet identifiant est inconnu');
        }
        // récupérer les données depuis la requete
        $userAsJson = $request->getContent();

        // modifier l'utilisateur
        $serializer->deserialize($userAsJson, User::class, JsonEncoder::FORMAT, [AbstractNormalizer::OBJECT_TO_POPULATE => $user]);
        
        // on veut vérifier si on nous a envoyé un mot de passe
        // pour cela on va désérialiser le json avec php et vérifier si un champ mot de passe existe
        $userStdObj = json_decode($userAsJson);

        if (isset($userStdObj->password))
        {
            $hashedPassword = $hasher->hashPassword($user, $userStdObj->password);
            $user->setPassword($hashedPassword);
        }

        $errors = $validator->validate($user);

        if (count($errors) > 0)
        {
            return JsonErrorResponse::sendError((string) $errors, Response::HTTP_BAD_REQUEST);
        }
        // enregistrer le user en BDD
        $entityManager = $doctrine->getManager();

        $entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }


    /**
     * Undocumented function
     * @Route("", name="list", methods="GET")
     * @return Response
     */
    public function list(UserRepository $userRepository): Response
    {
        // préparer les données
        $userList = $userRepository->findAll();

        return $this->json($userList, Response::HTTP_OK, [], ['groups' => "api_user"]);
    }


}