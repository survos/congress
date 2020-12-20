<?php

namespace App\Controller;

use App\Repository\LegislatorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(LegislatorRepository $legislatorRepository): Response
    {
        $legislators = $legislatorRepository->findBy([], [], 3);
        return $this->render('app/index.html.twig', [
            'legislators' => $legislators
        ]);
    }
}
