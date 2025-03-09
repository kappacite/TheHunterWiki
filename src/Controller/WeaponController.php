<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeaponController extends AbstractController
{
    #[Route('/weapon', name: 'app_weapon')]
    public function index(): Response
    {
        return $this->render('weapon/index.html.twig', [
            'controller_name' => 'WeaponController',
        ]);
    }
}
