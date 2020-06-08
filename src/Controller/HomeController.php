<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/hello/{prenom}/age/{age}", name="hello")
     * @Route("/hello", name="hello_base")
     * @Route("/hello/{prenom}", name="hello_prenom")
     * Montre la page qui dit bonjour
     *
     * @param string $prenom
     *
     * @param int    $age
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function hello($prenom = "anonyme", $age = 0)
    {
        return $this->render(
            'hello.html.twig',
            [
                'prenom' =>$prenom,
                'age' => $age
            ]
        );
    }

    /**
     * @Route("/", name="homepage")
     */
    public function home()
    {
        $prenoms = ["Lior" => 31, "Anteste" => 12, "Iliass" => 45];
        
        return $this->render(
            'home.html.twig',
            [
                'title' => "Bonjour à tous",
                'age' => rand(10,30),
                'tableau' => $prenoms
            ]
        );
    }
}
