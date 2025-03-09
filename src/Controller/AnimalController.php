<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalForm;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/animal')]
final class AnimalController extends AbstractController
{
    #[IsGranted("ROLE_ADMIN")]
    #[Route('/new', name: 'animal_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $animal = new Animal();
        $form = $this->createForm(AnimalForm::class, $animal);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            foreach($animal->getReserves() as $reserve) {
                $reserve->addAnimal($animal);
            }

            $entityManager->persist($animal);
            $entityManager->flush();
        }

        return $this->render('forms/new.html.twig', [
            'form' => $form->createView(),
            'create_msg' => "Créer un nouvel animal"
        ]);
    }

    #[Route('/', name: 'animal_index')]
    public function index(AnimalRepository $animalRepository): Response {
        $animals = $animalRepository->findAll();
        return $this->render('animal/index.html.twig', ['animals' => $animals]);
    }

    #[Route('/{id}', name: 'animal_show')]
    public function show(int $id, AnimalRepository $animalRepository): Response {
        $animal = $animalRepository->find($id);
        return $this->render('animal/show.html.twig', ['animal' => $animal]);
    }
}
