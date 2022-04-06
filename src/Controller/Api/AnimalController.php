<?php

namespace App\Controller\Api;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;

class AnimalController extends AbstractController
{
    /**
     * @Route("/api/animal", name="app_api_animal", methods={"POST"})
     */
    public function getResults(Request $request, SerializerInterface $serializer, AnimalRepository $aninalRepository, ValidatorInterface $validator, ManagerRegistry $doctrine): Response
    {

        // ! Récupérer le contenu JSON
        
        $jsonContent = $request->getContent();        
        //dd($request);
        $parsed_json = json_decode($jsonContent);

        dump($parsed_json);
        $genre = $parsed_json->gender;
        $child_compatibilty = $parsed_json->child_compatibility;    
    

        dump($child_compatibilty);
        dump($genre);
        // dd($child_compatibilty);

        $data = [
            'genre' => $genre,
            'atibility' => $child_compatibilty
        ];

        return $this->json($data, Response::HTTP_OK);
        


        $aninalRepository = $doctrine->getRepository(Animal::class);
        $animals = $aninalRepository->findAll();
        $encoders = [new JsonEncoder()];
        $normalizers = [new AnimalNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($animals, 'json');
        return new Response($jsonContent, Response::HTTP_OK, ['Content-Type' => 'application/json']);

            
    }
}



//* On veut récupérer un Json depuis le Front avec les critères de recherche    
//* On veut mettre en variable les critéres de recherches
//* On veut faire une requête sql qui réponds aux critères de recherche

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

class AnimaleController extends AbstractController
{

    /**
     * Get animal collection
     * 
     * @Route("/api/animal", name="api_animal_get", methods={"GET"})
     */
    public function getCollection(AnimalRepository $animalRepository): Response
    {
        
        // On va chercher les données
        $animalList = $animalRepository->findAll();

        return $this->json(
            // Les données à sérialiser (à convertir en JSON)
            $animalList,
            // Le status code
            200,
            // Les en-têtes de réponse à ajouter (aucune)
            [],
            // Les groupes à utiliser par le Serializer
            ['groups' => 'get_animal_collection']
        );
    }
}