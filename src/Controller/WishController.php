<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

    /**
     * @Route("/wishList", name="wishList")
     */
    public function wishList(): Response
    {
        $wishes = [
            'Arrêter de fumer',
            'Faire du sport',
            'Faire un saut en parachute',
            'Regarder Game of Thrones'
        ];

        return $this->render('wish/wishList.html.twig', [
            'wishes' => $wishes,
        ]);
    }

    /**
     * @Route("/wish/{id}", name="wish")
     */
    public function wish($id): Response
    {
        $wishes = [
            'Arrêter de fumer',
            'Faire du sport',
            'Faire un saut en parachute',
            'Regarder Game of Thrones'
        ];

        return $this->render('wish/wish.html.twig', [
            'id' => $id,
            'wish' => $wishes[$id],
        ]);
    }
}
