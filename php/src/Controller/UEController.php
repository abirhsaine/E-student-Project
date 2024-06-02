<?php

namespace App\Controller;

use App\Entity\UE;
use App\Form\UEType;
use App\Repository\UERepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ue')]
class UEController extends AbstractController
{
    #[Route('/', name: 'app_ue_index', methods: ['GET'])]
    public function index(UERepository $uERepository): Response
    {
        return $this->render('ue/index.html.twig', [
            'ues' => $uERepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ue_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UERepository $ueRepository): Response
    {
        $ue = new UE();
        $form = $this->createForm(UEType::class, $ue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ueRepository->add($ue);
            return $this->redirectToRoute('app_ue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ue/new.html.twig', [
            'ue' => $ue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ue_show', methods: ['GET'])]
    public function show(UE $ue): Response
    {
        return $this->render('ue/show.html.twig', [
            'ue' => $ue,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ue_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UE $ue, UERepository $ueRepository): Response
    {
        $form = $this->createForm(UEType::class, $ue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ueRepository->add($ue);
            return $this->redirectToRoute('app_ue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ue/edit.html.twig', [
            'ue' => $ue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ue_delete', methods: ['POST'])]
    public function delete(Request $request, UE $ue, UERepository $ueRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ue->getCode(), $request->request->get('_token'))) {
            $ueRepository->remove($ue);
        }

        return $this->redirectToRoute('app_ue_index', [], Response::HTTP_SEE_OTHER);
    }
}
