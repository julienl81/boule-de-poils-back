<?php

namespace App\Controller\Api;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class AnimalController extends AbstractController
{
    /**
     * @Route("/api/animal", name="app_api_animal")
     */
    public function getResults(Request $request, SerializerInterface $serializer, AnimalRepository $aninalRepository, ValidatorInterface $validator, ManagerRegistry $doctrine): Response
    {
        // ! Récupérer le contenu JSON
        $jsonContent = $request->getContent();

        
        // ! Désérialiser (convertir) le JSON en entité Doctrine
        try {
            $animal = $serializer->deserialize($jsonContent, Animal::class, 'json');
        } catch (NotEncodableValueException $e) {
            // Si le JSON fourni est "malformé" ou manquant, on prévient le client
            return $this->json(
                ['error' => 'JSON invalide'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        dd($animal);

        
        // Valider l'entité
        // @link : https://symfony.com/doc/current/validation.html#using-the-validator-service
        $errors = $validator->validate($animal);
        
        // Y'a-t-il des erreurs ?
        if (count($errors) > 0) {
            // tableau de retour
            $errorsClean = [];
            // @Retourner des erreurs de validation propres
            /** @var ConstraintViolation $error */
            foreach ($errors as $error) {
                $errorsClean[$error->getPropertyPath()][] = $error->getMessage();
            };

            return $this->json($errorsClean, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // On sauvegarde l'entité
        $entityManager = $doctrine->getManager();
        $entityManager->persist($animal);
        $entityManager->flush();
        
        
        
        
    }
}


//* On veut récupérer un Json depuis le Front avec les critères de recherche    
//* 

// public function findOneWithAllData($movieId): ?Movie
//     {
//         $entityManager = $this->getEntityManager();

//         $query = $entityManager->createQuery(
//             'SELECT m, g, c, p
//             FROM App\Entity\Movie m
//             JOIN m.genres g
//             JOIN m.castings c
//             JOIN c.person p
//             WHERE m.id = :id'
//         );
//         $query->setParameter('genre', $movieId);
//         $query->setParameter('enfant', $movieId);

//         // returns the movie or null if not found
//         return $query->getOneOrNullResult();
//     }
