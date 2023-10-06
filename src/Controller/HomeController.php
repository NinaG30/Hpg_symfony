<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\FormType;
use App\Entity\FormData;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'accueil')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formData = new FormData();
        $form = $this->createForm(FormType::class, $formData);
    
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
           
             // Obtenir la valeur soumise du champ montantFacture
             $montantFacture = $formData->getMontantFacture();
             $lngToiture = $formData->getLongueurToiture();
             $largeurToiture = $formData->getLargeurToiture();

             // Effectuer le calcul
             $resultatCalcul = $montantFacture / 0.20;
             $prod = $resultatCalcul*0.7;
             $d = round($prod / 1460);
             $dWC = $d * 1000;
             $nBP = ceil($dWC / 375);             
             $sT =  $lngToiture*$largeurToiture;
             $largueurP = 1.038;
             $lngP = 1.755;

             $nBPToiture = 1.755*1.038*$nBP;
             $result=null;
             $depart_nBP = $nBP;
            
            
            while ($nBPToiture >= $sT) {
                $nBP--;
                $nBPToiture = 1.755 * 1.038 * $nBP;
            
                if ($nBPToiture < $sT) {
                    $result = round($nBP*70/$depart_nBP);
                }
            }
            $result = round($nBP*70/$depart_nBP);

            // Persister l'entité en base de données si nécessaire
            // $entityManager->persist($formData);
            // $entityManager->flush();

            return $this->render('home/index.html.twig', [  
                'message' => 'Formulaire à remplir :',
                'form' => $form->createView(),              
                // 'resultatCalcul' => $resultatCalcul, // Transmettez le résultat du calcul au modèle Twig
                'nBP' => $nBP,
                'nBPToiture' => $nBPToiture,
                'SurfaceToiture' =>  $sT,           
                 'result'=> $result,
            ]);
        }  

        return $this->render('home/index.html.twig', [
            'message' => 'Formulaire à remplir :',
            'form' => $form->createView(),
        ]);
}
}