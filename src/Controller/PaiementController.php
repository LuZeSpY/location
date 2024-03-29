<?php

namespace App\Controller;

use App\Entity\Paiement;
use App\Entity\Locataire;
use App\Entity\Appartement;
use App\Form\PaiementType;
use App\Repository\PaiementRepository;
use App\Repository\AppartementRepository;
use App\Repository\LocataireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/paiement')]
class PaiementController extends AbstractController
{
    #[Route('/', name: 'app_paiement_index', methods: ['GET'])]
    public function index(PaiementRepository $paiementRepository, AppartementRepository $appartementRepository, LocataireRepository $locataireRepository): Response
    {
        $totalPaiement = $paiementRepository->createQueryBuilder('a')
        ->select('sum(a.montant)')
        ->getQuery()
        ->getSingleScalarResult();


        return $this->render('paiement/index.html.twig', [
            'paiements' => $paiementRepository->findAll(),
            'locataire' => $locataireRepository->findAll(),
            'appartements' => $appartementRepository->findAll(),
            'paiementTotal' => $totalPaiement
        ]);
    }

    #[Route('/new', name: 'app_paiement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PaiementRepository $paiementRepository): Response
    {
        $paiement = new Paiement();
        $form = $this->createForm(PaiementType::class, $paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paiementRepository->save($paiement, true);

            return $this->redirectToRoute('app_paiement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paiement/new.html.twig', [
            'paiement' => $paiement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paiement_show', methods: ['GET'])]
    public function show(Paiement $paiement, Locataire $locataire): Response
    {
        return $this->render('paiement/show.html.twig', [
            'paiement' => $paiement,
            'locataire' => $locataireRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_paiement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Paiement $paiement, PaiementRepository $paiementRepository): Response
    {
        $form = $this->createForm(PaiementType::class, $paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paiementRepository->save($paiement, true);

            return $this->redirectToRoute('app_paiement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paiement/edit.html.twig', [
            'paiement' => $paiement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paiement_delete', methods: ['POST'])]
    public function delete(Request $request, Paiement $paiement, PaiementRepository $paiementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paiement->getId(), $request->request->get('_token'))) {
            $paiementRepository->remove($paiement, true);
        }

        return $this->redirectToRoute('app_paiement_index', [], Response::HTTP_SEE_OTHER);
    }
}
