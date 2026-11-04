<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PatternController extends AbstractController
{
    #[Route('/hello/{name}', name: 'app_hello_name')]
public function greet(string $name): Response
{
    return new Response('Ciao ' . $name . '!');
}
}
