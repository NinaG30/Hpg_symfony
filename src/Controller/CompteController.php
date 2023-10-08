<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\FormData;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Result;

class CompteController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(Security $security, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = $security->getUser();

        // Vérifie si l'utilisateur est connecté
        if ($user instanceof UserInterface) {

            //Récupération des formulaires de l'utilisateur connecté
            $formDataRepository = $entityManager->getRepository(FormData::class);
            $formDatas = $formDataRepository->findBy(['user' => $user]);

            //Récupération des résultats liés à ses formulaires
            $resultRepository = $entityManager->getRepository(Result::class);
            $results = $resultRepository->findBy(['formData' => $formDatas]);

            return $this->render('compte/index.html.twig', [
                'user' => $user,
                'formDatas' => $formDatas,
                'results' => $results
            ]);
        }
    }
}
