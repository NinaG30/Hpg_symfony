<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\FormType;
use App\Entity\FormData;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\CalculService;
use \Symfony\Bundle\SecurityBundle\Security;

class HomeController extends AbstractController
{
    private $calculService;
    private $security;

    public function __construct(CalculService $calculService, Security $security)
    {
        $this->calculService = $calculService; //Injection de dépendance
        $this->security = $security;
    }

    #[Route('/accueil', name: 'accueil')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formData = new FormData();
        $form = $this->createForm(FormType::class, $formData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Récupère les valeurs de mes champs soumis
            $montantFacture = $formData->getMontantFacture();
            $lngToiture = $formData->getLongueurToiture();
            $largeurToiture = $formData->getLargeurToiture();

            if ($this->security->getUser()) {
                $user = $this->security->getUser();
                dump($user);
            }

            //Nombre de panneaux de 375 Wc nécessaires pour 70% d'économie
            $nBP = $this->calculService->effectuerCalcul($montantFacture, $lngToiture, $largeurToiture);

            //Surface totale de la toiture en m²
            $sT =  $lngToiture * $largeurToiture;

            //Largeur d'un panneau photovoltaique
            $largeurP = 1.038;
            //Longueur d'un panneau photovoltaique
            $lngP = 1.755;

            //Surface totale des panneaux nécessaires pour 70% d'économie  
            $nBPSurface = round($largeurP * $lngP * $nBP, 2);

            $result = null;

            //Stocke la valeur initiale de $nBP
            $depart_nBP = $nBP;


            while ($nBPSurface >= $sT) {
                $nBP--;
                $nBPSurface = $lngP * $largeurP * $nBP;

                if ($nBPSurface < $sT) {
                    $result = round($nBP * 70 / $depart_nBP);
                }
            }

            // Calcule le % d'économie réalisé en fonction des panneaux installables sur la surface de la toiture
            $result = round($nBP * 70 / $depart_nBP);

            $user = $this->getUser();


            if ($user !== null) {
                //Associe le user au formulaire
                $formData->setUser($user);
                dump($formData->setUser($user));


                // Persiste l'entité en base de données
                $entityManager->persist($formData);
                $entityManager->flush();
            }

            return $this->render('home/index.html.twig', [
                'message' => 'Formulaire à remplir :',
                'form' => $form->createView(),
                'nBP' => $nBP,
                'depart_nBP' => $depart_nBP,
                'nBPSurface' => $nBPSurface,
                'SurfaceToiture' =>  $sT,
                'result' => $result,
            ]);
        }

        return $this->render('home/index.html.twig', [
            'message' => 'Formulaire à remplir :',
            'form' => $form->createView(),
        ]);
    }
}
