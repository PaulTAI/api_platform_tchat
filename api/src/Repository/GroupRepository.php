<?php

namespace App\Repository;

use App\Entity\Group;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Group|null find($id, $lockMode = null, $lockVersion = null)
 * @method Group|null findOneBy(array $criteria, array $orderBy = null)
 * @method Group[]    findAll()
 * @method Group[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Group::class);
    }

    //apppel ajouter un utilisateur d'un groupe

    /**
     * add user in group
     * 
     * @param User $user
     * @param Group $group
     * @return void
     */
    public function insertUserInGroup(Collection $users, Group $group) {
        $em = $this->getEntityManager();

        for($i = 0; $i < \sizeof($users); $i++){
            $group->addUserList($users[$i]);
        }
         
        $em->persist($group);
        $em->flush();
    }

    // TODO appel pour supprimer un utilisateur d'un groupe 

    /**
     * 
     * @param User $user
     * @param Group $group
     * @return void
     */
    public function deleteUserFromGroup(Collection $users, Group $group) {
        $em = $this-> getEntityManager();

        for($i = 0; $i < \sizeof($users); $i++){
            $group->removeUserList($users[$i]);
        }
        $em->persist($group);
        $em->flush();
    }


    // /**
    //  * @return Group[] Returns an array of Group objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Group
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
