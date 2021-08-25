<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil(): Response
    {
        $personnes[0]["nom"] = "Willis";
        $personnes[0]["prenom"] = "Bruce";
        $personnes[1]["nom"] = "PITT";
        $personnes[1]["prenom"] = "Brad";
        $personnes[2]["nom"] = "CRUISE";
        $personnes[2]["prenom"] = "Tom";

        return $this->render('main/accueil.html.twig', [
            'personnes' => $personnes
        ]);
    }

    /**
     * @Route("/about-us", name="aboutUs")
     */
    public function aboutUs(): Response
    {
        return $this->render('main/aboutUs.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig');
    }
}
