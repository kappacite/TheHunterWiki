<?php

namespace App\Controller;

use App\Entity\Weapon;
use App\Form\WeaponFormType;
use App\Repository\WeaponRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/weapon', name:"weapon_app")]
final class WeaponController extends AbstractController
{

    #[IsGranted("ROLE_ADMIN")]
    #[Route('/new', name: 'weapon_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $weapon = new Weapon();
        $form = $this->createForm(WeaponFormType::class, $weapon);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($weapon);
            $entityManager->flush();
        }

        return $this->render('forms/new.html.twig', [
            'form' => $form->createView(),
            'create_msg' => "Créer une nouvelle arme"
        ]);
    }

    #[IsGranted("ROLE_ADMIN")]
    #[Route('/edit/{id}', name: 'weapon_edit')]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {

        $weapon = $entityManager->getRepository(Weapon::class)->find($id);
        $form = $this->createForm(WeaponFormType::class, $weapon);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();
        }

        return $this->render('forms/new.html.twig', [
            'form' => $form->createView(),
            'create_msg' => "Editer une arme"
        ]);
    }

    #[Route('/weapon', name: 'weapon_index')]
    public function index(): Response
    {
        return $this->render('weapon/index.html.twig', [
            'controller_name' => 'WeaponController',
        ]);
    }
}
