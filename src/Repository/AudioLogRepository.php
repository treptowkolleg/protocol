<?php

namespace App\Repository;

use App\Entity\AudioLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AudioLog>
 */
class AudioLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AudioLog::class);
    }

    /**
     * @return array Returns an array of AudioLog objects
     * @throws Exception
     */
    public function findDates(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                SELECT created_at, DATE(created_at) AS day, COUNT(id) AS count
                FROM audio_log
                GROUP BY day
                ORDER BY day DESC
            ';

        $stmt = $conn->prepare($sql);
        return $stmt->executeQuery()->fetchAllAssociative();
    }

    /**
     * @param \DateTimeInterface $date
     * @return AudioLog[]
     */
    public function findByDate(\DateTimeInterface $date): array
    {
        $start = (clone $date)->setTime(0, 0, 0);
        $end = (clone $date)->setTime(23, 59, 59);

        return $this->createQueryBuilder('a')
            ->where('a.createdAt BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->orderBy('a.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?AudioLog
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
