<?php

namespace App\Controller\Back;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/animal")
 * @IsGranted("ROLE_ASSOCIATION")
 */
class AnimalController extends AbstractController
{
    /**
     * @Route("/", name="app_animal_index", methods={"GET"})
     */
    public function index(AnimalRepository $animalRepository): Response
    {
        // if (isGranted('ROLE_ASSOCIATION'))
        return $this->render('back/animal/index.html.twig', [
            'animals' => $animalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_animal_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AnimalRepository $animalRepository): Response
    {
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $animalRepository->add($animal);
            return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/animal/new.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_animal_show", methods={"GET"})
     */
    public function show(Animal $animal): Response
    {
        //dd($animal->getGardenNeeded());
        return $this->render('back/animal/show.html.twig', [
            'animal' => $animal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_animal_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Animal $animal, AnimalRepository $animalRepository): Response
    {
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $animalRepository->add($animal);
            return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_animal_delete", methods={"POST"})
     */
    public function delete(Request $request, Animal $animal, AnimalRepository $animalRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animal->getId(), $request->request->get('_token'))) {
            $animalRepository->remove($animal);
        }

        return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
    }
}
