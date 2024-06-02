<?php

namespace App\Controller;

use App\Entity\ParcoursType;
use App\Entity\Semestre;
use App\Form\AjoutSemestreParcoursType;
use App\Form\ParcoursTypeType;
use App\Repository\ParcoursTypeRepository;
use App\Repository\SemestreRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/parcours')]
class ParcoursTypeController extends AbstractController
{
    #[Route('/', name: 'app_parcours_type_index', methods: ['GET'])]
    public function index(ParcoursTypeRepository $parcoursTypeRepository): Response
    {
        return $this->render('parcours_type/index.html.twig', [
            'parcours_types' => $parcoursTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_parcours_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ParcoursTypeRepository $parcoursTypeRepository): Response
    {
        $parcoursType = new ParcoursType();
        $form = $this->createForm(ParcoursTypeType::class, $parcoursType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcoursTypeRepository->add($parcoursType);
            return $this->redirectToRoute('app_parcours_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours_type/new.html.twig', [
            'parcours_type' => $parcoursType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parcours_type_show', methods: ['GET', 'POST'])]
    public function show(
        ParcoursType $parcoursType,
        SemestreRepository $semestreRepository,
        Request $request,
        LoggerInterface $logger
    ): Response
    {
        $semestre = new Semestre();
        $semestre->setParcoursType($parcoursType);
        $semestre->setAnnee(date('Y'));
        $ajoutSemestreForm = $this->createForm(AjoutSemestreParcoursType::class, $semestre);
        $ajoutSemestreForm->handleRequest($request);

        if ($ajoutSemestreForm->isSubmitted() && $ajoutSemestreForm->isValid()) {
            $semestre->setParcoursType($parcoursType);

            $semestreDuplicate = $semestreRepository->findOneBy([
                'annee' => $semestre->getAnnee(),
                'pair' => $semestre->getPair(),
                'parcours_type' => $parcoursType,
            ]);

            // Données propres
            if ($semestre->getType() != "Académique") {
                $semestre->clearUE();
            }

            // Recherche de duplicata
            if ($semestreDuplicate) {
                $this->addFlash("error", "Le semestre existe déjà.");
            } else {
                $semestreRepository->add($semestre);
            }

            return $this->redirectToRoute('app_parcours_type_show', ["id" => $parcoursType->getId()], Response::HTTP_SEE_OTHER);
        }

        $semestres = $semestreRepository->findBy([
            'parcours_type' => $parcoursType
        ], [
            'annee' => 'ASC', 'pair' => 'ASC'
        ]);

        return $this->renderForm('parcours_type/show.html.twig', [
            'parcours_type' => $parcoursType,
            'semestres' => $semestres,
            'ajoutSemestreForm' => $ajoutSemestreForm
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parcours_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ParcoursType $parcoursType, ParcoursTypeRepository $parcoursTypeRepository): Response
    {
        $form = $this->createForm(ParcoursTypeType::class, $parcoursType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcoursTypeRepository->add($parcoursType);
            return $this->redirectToRoute('app_parcours_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours_type/edit.html.twig', [
            'parcours_type' => $parcoursType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parcours_type_delete', methods: ['POST'])]
    public function delete(Request $request, ParcoursType $parcoursType, ParcoursTypeRepository $parcoursTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parcoursType->getId(), $request->request->get('_token'))) {
            $parcoursTypeRepository->remove($parcoursType);
        }

        return $this->redirectToRoute('app_parcours_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
