<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/hello/{name}', name: 'app_hello')]
    public function hello(string $name): Response
    {
        return $this->render('pattern/index.html.twig', [
            'name' => $name,
        ]);
    }
    #[Route('/patterns', name: 'app_patterns')]
public function patterns(): Response
{
    return $this->render('pattern/index.html.twig');
}
}