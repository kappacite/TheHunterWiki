<?php

namespace App\Controller;

use App\Entity\Reserve;
use App\Form\ReserveForm;
use App\Repository\ReserveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reserve', name: 'reserver_app')]
final class ReserveController extends AbstractController
{
    #[Route('/new', name: 'reserve_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $reserve = new Reserve();
        $form = $this->createForm(ReserveForm::class, $reserve);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($reserve->getAnimals() as $animal) {
                $animal->addReserve($reserve);
            }

            $entityManager->persist($reserve);
            $entityManager->flush();
            $this->redirectToRoute('/reserve/'.$reserve->getId());
        }

        return $this->render('forms/new.html.twig', [
            'form' => $form->createView(),
            'create_msg' => "Créer une nouvelle réserve"
        ]);
    }


    #[Route('/', name: 'reserve_index')]
    public function index(EntityManagerInterface $entityManager){
        return $this->render('reserve/index.html.twig', [
            'reserves' => $entityManager->getRepository(Reserve::class)->findAll(),
        ]);
    }
    #[Route('/{id}', name: 'reserve_show')]
    public function show(int $id, ReserveRepository $reserveRepository){

        $reserve = $reserveRepository->find($id);

        return $this->render('reserve/show.html.twig', [
            'reserve' => $reserve
        ]);
    }
}
