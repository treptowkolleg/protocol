<?php

namespace App\Controller;

use App\Entity\AudioLog;
use App\Repository\AudioLogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('audio-log', name: 'audio_log_')]
class AudioLogController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(Request $request, AudioLogRepository $repository): Response
    {
        $date = $request->get('date') ?? 'all';
        if($date == 'all')
            $audioLogs = $repository->findAll();
        else
            $audioLogs = $repository->findByDate(\DateTimeImmutable::createFromFormat('Y-m-d',$date));

        return $this->render("audio_log_list.html.twig",[
            'logs' => $audioLogs,
        ]);
    }

    #[Route('/{id}/show', name: 'show')]
    public function show(AudioLog $audioLog): Response
    {

        return $this->render("audio_log_modal.html.twig",[
            'log' => $audioLog,
        ]);
    }

}
