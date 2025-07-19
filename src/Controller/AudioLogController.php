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
        $ascending = $request->get('asc') ?? 0;
        $sortProperty = $request->get('property') ?? 'createdAt';
        $date = $request->get('date') ?? 'all';
        if($date == 'all')
            $audioLogs = $repository->findAll();
        else
            $audioLogs = $repository->findByDate(\DateTimeImmutable::createFromFormat('Y-m-d',$date));

        $this->sortEntitiesBy($audioLogs,$sortProperty, $ascending);

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

    private function sortEntitiesBy(array &$entities, string $property, bool $ascending = true): void {
        usort($entities, function ($a, $b) use ($property, $ascending) {
            $getter = 'get' . ucfirst($property);

            if (!method_exists($a, $getter) || !method_exists($b, $getter)) {
                throw new \InvalidArgumentException("Method $getter does not exist.");
            }

            $valueA = $a->$getter();
            $valueB = $b->$getter();

            // Für Strings:
            $result = is_string($valueA) ? strcmp($valueA, $valueB) : ($valueA <=> $valueB);
            return $ascending ? $result : -$result;
        });
    }

}
