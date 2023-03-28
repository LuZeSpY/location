<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\AppartementRepository;
use App\Repository\LocataireRepository;
use App\Entity\Appartement;
use App\Entity\Locataire;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(AppartementRepository $appartementRepository, LocataireRepository $locataireRepository): Response
    {

        $totalAppartement = $appartementRepository->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $totalLocataire = $locataireRepository->createQueryBuilder('a')
        ->select('count(a.id)')
        ->getQuery()
        ->getSingleScalarResult();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'appartementTotal' => $totalAppartement,
            'locataireTotal' => $totalLocataire,
        ]);
    }



}

?>