<?php

namespace App\Controller;

use App\Form\EditWishType;
use App\Repository\WishRepository;
use App\Entity\Wish;
use App\Form\AddWishType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{

    /**
     * @Route("/wish-list", name="wishList")
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
     * @Route("/admin/wish-list", name="adminWishList")
     */
    public function adminWishList(WishRepository $wishRepo): Response
    {
        $wishes = $wishRepo->findAll();

        return $this->render('wish/adminWishList.html.twig', [
            'wishes' => $wishes,
        ]);
    }

    /**
     * @Route("/admin/add-wish", name="adminAddWish")
     */
    public function addWish(Request $request, EntityManagerInterface $em): Response
    {
        $wish = new Wish();

        $formAddWish = $this->createForm(AddWishType::class, $wish);

        $formAddWish->handleRequest($request);
        if ($formAddWish->isSubmitted()){
            $wish->setIsPublished(true);
            $wish->setDateCreated(new \DateTime());
            $em->persist($wish);
            $em->flush();
            return $this->redirectToRoute('wishList');
        }

        return $this->render('wish/adminAddWish.html.twig', [
            'formWish' => $formAddWish->createView(),
        ]);
    }

    /**
     * @Route("/admin/edit-wish/{id}", name="adminEditWish")
     */
    public function adminEditWish(Wish $wish, Request $request, EntityManagerInterface $em): Response
    {
        $formEditWish = $this->createForm(EditWishType::class, $wish);

        $formEditWish->handleRequest($request);
        if ($formEditWish->isSubmitted()){
            $em->persist($wish);
            $em->flush();
            return $this->redirectToRoute('adminWishList');
        }

        return $this->render('wish/adminEditWish.html.twig', [
            'formWish' => $formEditWish->createView(),
        ]);
    }

    /**
     * @Route("/admin/brut-add-wish", name="adminBrutAddWish")
     */
    public function adminBrutAddWish(Request $request, EntityManagerInterface $em): Response
    {
        $title = $request->get('add_wish')['title'];
        $description = $request->get('add_wish')['description'];

        $wish = new Wish();

        $wish->setTitle($title);
        $wish->setDescription($description);
        $wish->setAuthor('Admin');
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());

        $em->persist($wish);
        $em->flush();

        return $this->redirectToRoute('adminWishList');
    }


    /**
     * @Route("/admin/delete-wish/{id}", name="adminDeleteWish")
     */
    public function adminDeleteWish(Wish $wish, Request $request, EntityManagerInterface $em): Response
    {
        if ($request->getMethod() == 'POST'){
            $em->remove($wish);
            $em->flush();

            return $this->redirectToRoute('adminWishList');
        }


        return $this->render('wish/adminDeleteWish.html.twig', [
            'wish' => $wish,
        ]);
    }
}
