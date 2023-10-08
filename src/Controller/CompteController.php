<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\FormData;
use Doctrine\ORM\EntityManagerInterface;

class CompteController extends AbstractController
{
    #[Route('/compte', name: 'app_compte')]
    public function index(Security $security, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = $security->getUser();

        // Vérifie si l'utilisateur est connecté
        if ($user instanceof UserInterface) {

            $formDataRepository = $entityManager->getRepository(FormData::class);
            $formDatas = $formDataRepository->findBy(['user' => $user]);
            dump($formDatas);

            return $this->render('compte/index.html.twig', [
                'user' => $user,
                'formDatas' => $formDatas
            ]);
        }
    }
}
