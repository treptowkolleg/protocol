<?php

namespace App\Controller;

use App\Entity\AudioLog;
use App\Repository\AudioLogRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('create', name: 'create')]
    public function create(EntityManagerInterface $entityManager)
    {
        $audioLog = new AudioLog();
        $audioLog->setSessionNumber(1);
        $audioLog->setPartNumber(2);
        $audioLog->setSpeaker('Ben');
        $audioLog->setSubject('Testaufnahme');
        $audioLog->setTransript('Ich bin der Ben und mache eine Testaufnahme');
        $audioLog->setSummary("Ben testet die Aufnahmefunktion");

        $entityManager->persist($audioLog);
        $entityManager->flush();

        return new Response('OK');
    }

}
