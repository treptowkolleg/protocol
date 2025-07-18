<?php

namespace App\Controller;

use App\Repository\AudioLogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('audio-log/', name: 'audio_log_')]
class AudioLogController extends AbstractController
{

    #[Route('', name: 'index')]
    public function index(AudioLogRepository $repository): Response
    {
        $audioLogs = $repository->findAll();

        return $this->render("audio_log_list.html.twig",[
            'logs' => $audioLogs
        ]);
    }

}
