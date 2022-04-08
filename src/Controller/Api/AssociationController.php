<?php

namespace App\Controller\Api;

use App\Repository\AssociationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssociationController extends AbstractController
{
    /**
     * @Route("/api/association", name="app_api_association")
     */
    public function associationList(AssociationRepository $associationRepository): Response
    {
        $associations = $associationRepository->findAll();

        return $this->json($associations, Response::HTTP_OK,[], ['groups' => 'api_associations_list']);
    }
}
