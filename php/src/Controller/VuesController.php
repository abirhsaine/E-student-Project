<?php

namespace App\Controller;

use App\Repository\Vue2CesureRepository;
use App\Repository\VueAcquisXRepository;
use App\Repository\VueAjourneeAGGRepository;
use App\Repository\VueAjourneeDetailsRepository;
use App\Repository\VueCesureRepository;
use App\Repository\VueDiplomesRepository;
use App\Repository\VueECTSRepository;
use App\Repository\VueInscritsUERepository;
use App\Repository\VueInscritsUniteRepository;
use App\Repository\VueModuleImpairRepository;
use App\Repository\VueModuleNbUERepository;
use App\Repository\VueModulePairRepository;
use App\Repository\VueUEImpairPairRepository;
use App\Repository\VueUEImpairRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VueUEPairRepository;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class VuesController extends AbstractController
{
    #[Route('/vues/{name}', name: 'app_vues')]
    public function index($name, VueInscritsUniteRepository $vueInscritsUniteRepository,VueAcquisXRepository $vueAcquisXRepository,VueInscritsUERepository $vueInscritsUERepository,VueDiplomesRepository $vueDiplomesRepository,VueECTSRepository $vueECTSRepository,Vue2CesureRepository $vue2CesureRepository,VueCesureRepository $vueCesureRepository,VueAjourneeAGGRepository $vueAjourneeAGGRepository,VueAjourneeDetailsRepository $vueAjourneeDetailsRepository,VueModulePairRepository $vueModulePairRepository,VueModuleImpairRepository $vueModuleImpairRepository,VueModuleNbUERepository $vueModuleNbUERepository,VueUEImpairPairRepository $vueUEImpairPairRepository, VueUEPairRepository $vueUEPairRepository, VueUEImpairRepository $vueUEImpairRepository, NormalizerInterface $normalizerInterface): Response
    {
        switch ($name){
            case 'VueUEPair': 
                $donnees = $vueUEPairRepository->findAll();
                break;
            case 'VueUEImpair': 
                $donnees = $vueUEImpairRepository->findAll();
                break;
            case 'VueUEImpairPair': 
                $donnees = $vueUEImpairPairRepository->findAll();
                break;
            case 'VueModuleNbUE': 
                $donnees = $vueModuleNbUERepository->findAll();
                break;
            case 'VueModuleImpair': 
                $donnees = $vueModuleImpairRepository->findAll();
                break;
            case 'VueModulePair': 
                $donnees = $vueModulePairRepository->findAll();
                break;
            case 'VueAjourneeDetails': 
                $donnees = $vueAjourneeDetailsRepository->findAll();
                break;
            case 'VueAjourneeAGG': 
                $donnees = $vueAjourneeAGGRepository->findAll();
                break;
            case 'VueCesure': 
                $donnees = $vueCesureRepository->findAll();
                break;
            case 'Vue2Cesure': 
                $donnees = $vue2CesureRepository->findAll();
                break;
            case 'VueECTS': 
                $donnees = $vueECTSRepository->findAll();
                break;
            case 'VueDiplomes': 
                $donnees = $vueDiplomesRepository->findAll();
                break;
            case 'VueInscritsUE': 
                $donnees = $vueInscritsUERepository->findAll();
                break;
            case 'VueAcquisX':
                $donnees = $vueAcquisXRepository->findAll();
                break;
            case 'VueInscritsUnite':
                $donnees = $vueInscritsUniteRepository->findAll();
                break;
            default:
                break;
        } 
        return $this->render('vues/index.html.twig', [
            'controller_name' => 'VuesController',
            'nomvue' => $name,
            'donnees' => $normalizerInterface->normalize($donnees)
        ]);
    }
}
