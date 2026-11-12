<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Scan;
use App\Form\ScanType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class ScanController extends AbstractController
{
    #[Route('/scan', name: 'app_scan')]
    #[Route('/scan/new', name: 'scan_new')]
public function new(
    Request $request,
    EntityManagerInterface $entityManager
): Response {
    // 1. Creiamo una nuova scansione
    $scan = new Scan();

    // 2. Creiamo il form collegato all'oggetto Scan
    $form = $this->createForm(ScanType::class, $scan);

    // 3. Gestiamo i dati inviati dall'utente
    $form->handleRequest($request);

    // 4. Controlliamo se il form è stato inviato ed è valido
    if ($form->isSubmitted() && $form->isValid()) {

        // 5. Salviamo la scansione nel database
        $entityManager->persist($scan);
        $entityManager->flush();

        // 6. Torniamo alla pagina /scan
        return $this->redirectToRoute('app_scan');
    }

    // 7. Mostriamo il form
    return $this->render('scan/new.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
