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
use App\Entity\Result;

class HomeController extends AbstractController
{
    private $calculService;
    private $security;

    public function __construct(CalculService $calculService, Security $security)
    {
         //Injection de dépendances
        $this->calculService = $calculService;
        $this->security = $security;
    }

    #[Route('/accueil', name: 'app_home')]    
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

            //Permet de savoir combien de panneaux sont installables au maximum sur la toiture
            while ($nBPSurface >= $sT) {
                $nBP--;
                $nBPSurface = $lngP * $largeurP * $nBP;

                if ($nBPSurface < $sT) {
                    $result = round($nBP * 70 / $depart_nBP);
                }
            }

            // Calcule le % d'économie en fonction des panneaux installables sur la surface de la toiture
            $result = round($nBP * 70 / $depart_nBP);

            //S'il y a un utilisateur connecté
            if ($this->security->getUser()) {

                //Je stocke l'utilisateur dans une variable 
                $user = $this->security->getUser();

                //Associe le user au formulaire
                $formData->setUser($user);

                // Crée une nouvelle instance de l'entité Result
                $resultEntity = new Result();

                // Attribue les valeurs aux propriétés de l'entité Result
                $resultEntity->setPanneauxNecessaires($depart_nBP);
                $resultEntity->setPanneauxInstallables($nBP);
                $resultEntity->setEconomie($result);

                // Associe le formulaire à l'entité Result
                $resultEntity->setFormData($formData);

                // Persiste l'entité Result en base de données
                $entityManager->persist($resultEntity);
                $entityManager->flush();

                // Persiste l'entité formData en base de données
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
