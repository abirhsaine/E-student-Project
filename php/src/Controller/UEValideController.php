<?php

namespace App\Controller;

use App\Entity\UEValide;
use App\Form\UEValideType;
use App\Repository\UEValideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/u/e/valide')]
class UEValideController extends AbstractController
{
    #[Route('/', name: 'app_u_e_valide_index', methods: ['GET'])]
    public function index(UEValideRepository $uEValideRepository): Response
    {
        return $this->render('ue_valide/index.html.twig', [
            'u_e_valides' => $uEValideRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_u_e_valide_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UEValideRepository $uEValideRepository): Response
    {
        $uEValide = new UEValide();
        $form = $this->createForm(UEValideType::class, $uEValide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uEValideRepository->add($uEValide);
            return $this->redirectToRoute('app_u_e_valide_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ue_valide/new.html.twig', [
            'u_e_valide' => $uEValide,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_u_e_valide_show', methods: ['GET'])]
    public function show(UEValide $uEValide): Response
    {
        return $this->render('ue_valide/show.html.twig', [
            'u_e_valide' => $uEValide,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_u_e_valide_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UEValide $uEValide, UEValideRepository $uEValideRepository): Response
    {
        $form = $this->createForm(UEValideType::class, $uEValide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uEValideRepository->add($uEValide);
            return $this->redirectToRoute('app_u_e_valide_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ue_valide/edit.html.twig', [
            'u_e_valide' => $uEValide,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_u_e_valide_delete', methods: ['POST'])]
    public function delete(Request $request, UEValide $uEValide, UEValideRepository $uEValideRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$uEValide->getId(), $request->request->get('_token'))) {
            $uEValideRepository->remove($uEValide);
        }

        return $this->redirectToRoute('app_u_e_valide_index', [], Response::HTTP_SEE_OTHER);
    }
}
