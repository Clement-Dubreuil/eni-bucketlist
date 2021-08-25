<?php

namespace App\Controller;

use App\Repository\WishRepository;
use App\Entity\Wish;
use Doctrine\ORM\EntityManagerInterface;
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
    public function wish(Wish $wish): Response
    {
        return $this->render('wish/wish.html.twig', [
            'wish' => $wish,
        ]);
    }

    /**
     * @Route("/add-wish", name="addWish")
     */
    public function addWish(EntityManagerInterface $em): Response
    {
        $wish = new Wish();
        $wish->setTitle('Manger sainement');
        $wish->setDescription('Il faut manger sainement pour être en bonne santé !');
        $wish->setAuthor('Clément');
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());

        $em->persist($wish);
        $em->flush();

        return $this->redirectToRoute('wishList');
    }
}
