<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

    /**
     * @Route("/wishList", name="wishList")
     */
    public function wishList(WishRepository $wishRepo): Response
    {
        $wishes = $wishRepo->findAllPublished();

        return $this->render('wish/wishList.html.twig', [
            'wishes' => $wishes,
        ]);
    }

    /**
     * @Route("/wish/{id}", name="wish")
     */
    public function wish($id, WishRepository $wishRepo): Response
    {
        $wish = $wishRepo->find($id);

        return $this->render('wish/wish.html.twig', [
            'wish' => $wish,
        ]);
    }
}
