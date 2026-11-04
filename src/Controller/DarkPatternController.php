<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\DarkPattern;
use Doctrine\ORM\EntityManagerInterface;

final class DarkPatternController extends AbstractController
{
    #[Route('/dark/pattern', name: 'app_dark_pattern')]
   public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(DarkPattern::class);
        $patterns = $repository->findAll();

$existingPattern = $repository->findOneBy([
    'name' => 'Fake Urgency'
]);

if (!$existingPattern) {
    $pattern = new DarkPattern();

    $pattern->setName('Fake Urgency');
    $pattern->setDescription(
        'Crea una falsa sensazione di urgenza per spingere l’utente ad acquistare rapidamente.'
    );

    $entityManager->persist($pattern);
    $entityManager->flush();
}

return $this->render('dark_pattern/index.html.twig', [
    'patterns' => $patterns,
]);
    }
    
}
