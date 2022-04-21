<?php

namespace App\Controller\Back;

use App\Entity\Species;
use App\Form\SpeciesType;
use App\Repository\SpeciesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/species")
 * @IsGranted("ROLE_ADMIN")
 */
class SpeciesController extends AbstractController
{
    /**
     * @Route("/", name="app_species_index", methods={"GET"})
     */
    public function index(SpeciesRepository $speciesRepository): Response
    {
        return $this->render('back/species/index.html.twig', [
            'species' => $speciesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_species_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SpeciesRepository $speciesRepository): Response
    {
        $species = new Species();
        $form = $this->createForm(SpeciesType::class, $species);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $speciesRepository->add($species);
            return $this->redirectToRoute('app_species_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/species/new.html.twig', [
            'species' => $species,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_species_show", methods={"GET"})
     */
    public function show(Species $species): Response
    {
        return $this->render('back/species/show.html.twig', [
            'species' => $species,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_species_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Species $species, SpeciesRepository $speciesRepository): Response
    {
        $form = $this->createForm(SpeciesType::class, $species);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $speciesRepository->add($species);
            return $this->redirectToRoute('app_species_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/species/edit.html.twig', [
            'species' => $species,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_species_delete", methods={"POST"})
     */
    public function delete(Request $request, Species $species, SpeciesRepository $speciesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$species->getId(), $request->request->get('_token'))) {
            $speciesRepository->remove($species);
        }

        return $this->redirectToRoute('app_species_index', [], Response::HTTP_SEE_OTHER);
    }
}
