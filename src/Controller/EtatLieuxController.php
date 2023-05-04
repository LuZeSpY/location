<?php

namespace App\Controller;

use App\Entity\EtatLieux;
use App\Entity\Appartement;
use App\Form\EtatLieuxType;
use App\Form\AppartementType;
use App\Repository\EtatLieuxRepository;
use App\Repository\AppartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etatlieux')]
class EtatLieuxController extends AbstractController
{
    #[Route('/', name: 'app_etat_lieux_index', methods: ['GET'])]
    public function index(EtatLieuxRepository $etatLieuxRepository, AppartementRepository $appartementRepository): Response
    {
        return $this->render('etat_lieux/index.html.twig', [
            'etat_lieuxes' => $etatLieuxRepository->findAll(),
            'appartements' => $appartementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_etat_lieux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EtatLieuxRepository $etatLieuxRepository): Response
    {
        $etatLieux = new EtatLieux();
        $form = $this->createForm(EtatLieuxType::class, $etatLieux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etatLieuxRepository->save($etatLieux, true);

            return $this->redirectToRoute('app_etat_lieux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etat_lieux/new.html.twig', [
            'etat_lieux' => $etatLieux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etat_lieux_show', methods: ['GET'])]
    public function show(EtatLieux $etatLieux): Response
    {
        return $this->render('etat_lieux/show.html.twig', [
            'etat_lieux' => $etatLieux,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etat_lieux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EtatLieux $etatLieux, EtatLieuxRepository $etatLieuxRepository): Response
    {
        $form = $this->createForm(EtatLieuxType::class, $etatLieux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etatLieuxRepository->save($etatLieux, true);

            return $this->redirectToRoute('app_etat_lieux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etat_lieux/edit.html.twig', [
            'etat_lieux' => $etatLieux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etat_lieux_delete', methods: ['POST'])]
    public function delete(Request $request, EtatLieux $etatLieux, EtatLieuxRepository $etatLieuxRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etatLieux->getId(), $request->request->get('_token'))) {
            $etatLieuxRepository->remove($etatLieux, true);
        }

        return $this->redirectToRoute('app_etat_lieux_index', [], Response::HTTP_SEE_OTHER);
    }
}
