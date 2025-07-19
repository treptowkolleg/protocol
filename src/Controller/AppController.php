<?php

namespace App\Controller;

use App\Repository\AudioLogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_')]
class AppController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(AudioLogRepository $repository): Response
    {
        $dates = $repository->findDates();
        return $this->render("base.html.twig",[
            'dates' => $dates,
        ]);
    }

}
