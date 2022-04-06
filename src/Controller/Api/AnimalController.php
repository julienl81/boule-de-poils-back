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
        
        //* On veut récupérer un Json depuis le Front avec les critères de recherche    
        //* On veut mettre en variable les critéres de recherches
        //* On veut faire une requête sql qui réponds aux critères de recherche
        
        dump($child_compatibilty);
        dump($genre);
        // dd($child_compatibilty);

        $data = [
            'gender' => $genre,
            'childCompatibility' => $child_compatibilty
        ];

        return $this->json($data, Response::HTTP_OK);
                
    }

    /**
     * @Route("/api/animal", name="app_api_animal_list", methods={"GET"})
     */
    public function animalList(AnimalRepository $animalRepository): Response
    {
        $animals = $animalRepository->findAll();
        //dump($animals);

        return $this->json($animals, Response::HTTP_OK,[],['groups' => 'api_animals_list']);
    }
}





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

