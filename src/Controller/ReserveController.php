<?php

namespace App\Controller;

use App\Entity\Reserve;
use App\Form\ReserveForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReserveController extends AbstractController
{
    #[Route('/reserve/new', name: 'app_reserve')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $reserve = new Reserve();
        $form = $this->createForm(ReserveForm::class, $reserve);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            foreach($reserve->getAnimals() as $animal) {
                $animal->addReserve($reserve);
            }

            $entityManager->persist($reserve);
            $entityManager->flush();
        }

        return $this->render('forms/new.html.twig', [
            'form' => $form->createView(),
            'create_msg' => "Créer une nouvelle réserve"
        ]);
    }
}
