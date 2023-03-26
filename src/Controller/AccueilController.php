<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\AppartementRepository;
use App\Entity\Appartement;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(AppartementRepository $appartementRepository): Response
    {

        $totalAppartement = $appartementRepository->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'appartementTotal' => $totalAppartement,
        ]);
    }

}

?>