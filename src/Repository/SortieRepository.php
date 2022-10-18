<?php

namespace App\Repository;

use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sortie>
 *
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    public function save(Sortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Sortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Sortie[] Returns an array of Sortie objects
     */
    public function searchSortie($arrayRequest): array
    {
        $query = $this->createQueryBuilder('s');
        if ($arrayRequest['site'] != "") {
            $query->join('s.organisateur', 'o');
            $query->join('o.site', 'site');
            $query->andWhere('o.site = :site_id')->setParameter('site_id', $arrayRequest['site']);;
            $query->andWhere('s.nom LIKE :mot_cle')->setParameter('mot_cle', '%' . $arrayRequest['mot_cle'] . '%');
        }
        if ($arrayRequest['mot_cle'] != "") {
            $query->andWhere('s.nom LIKE :mot_cle')->setParameter('mot_cle', '%' . $arrayRequest['mot_cle'] . '%');
        }
        if ($arrayRequest['date_debut'] != "") {
            $query->andWhere('s.date_debut_sortie > :date_debut')->setParameter('date_debut', $arrayRequest['date_debut']);
        }
        if ($arrayRequest['date_fin'] != "") {
            $query->andWhere('s.date_debut_sortie < :date_fin')->setParameter('date_fin', $arrayRequest['date_fin']);
        }
        if ($arrayRequest['organisateur']) {
            $query->andWhere('s.organisateur = :organisateur')->setParameter('organisateur', $arrayRequest['user_id']);
        }
        if ($arrayRequest['inscrit']) {
            $query->Leftjoin('s.sortie', 'i');
            $query->andWhere('i.utilisateur = :inscrit')->setParameter('inscrit', $arrayRequest['user_id']);
        }
        if ($arrayRequest['passe']) {
            $query->andWhere('s.date_fin_sortie < :now')->setParameter('now', new \DateTime());
        }
        $query->orderBy('s.date_debut_sortie', 'DESC')
            ->setMaxResults(10);

        return $query->getQuery()->getResult();
    }

//    public function findOneBySomeField($value): ?Sortie
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
