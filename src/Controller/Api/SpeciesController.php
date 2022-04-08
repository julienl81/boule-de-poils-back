<?php

namespace App\Controller\Api;

use App\Entity\Species;
use App\Form\SpeciesType;
use App\Repository\SpeciesRepository;
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


class SpeciesController extends AbstractController
{
    /**
     * @Route("/api/species", name="app_api_species", methods={"GET"})
     */
    public function speciesList(SpeciesRepository $speciesRepository): Response
    {
        $species = $speciesRepository->findAll();

        return $this->json($species, Response::HTTP_OK, [],['groups' => 'api_species_list']);
    }

}
