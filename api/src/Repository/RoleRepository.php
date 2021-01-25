<?php

namespace App\Repository;

use App\Entity\Role;
use App\Entity\Group;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Role|null find($id, $lockMode = null, $lockVersion = null)
 * @method Role|null findOneBy(array $criteria, array $orderBy = null)
 * @method Role[]    findAll()
 * @method Role[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }

    /**
     * insert role
     *
     * @param string $name
     * @param Collection $rights
     * @param Collection $users
     * @param Group $group
     * @return void
     */
    public function insertRole(string $name, Collection $rights, Collection $users, Group $group){
        $em = $this->getEntityManager();
        $role = new Role();
        $role->setName($name);
        $role->setRoleGroup($group);
        for($i = 0; $i < \sizeof($rights); $i++){
            $role->addRight($rights[$i]);
        }
        for($j = 0; $j < \sizeof($users); $j++){
            $role->addUser($users[$j]);
        }
        $em->persist($role);
        $em->flush();
    }

    /**
     * delete role
     *
     * @param Role $role
     * @return void
     */
    public function deleteRole(Role $role){
        $em = $this->getEntityManager();
        $em->remove($role);
        $em->flush();
    }

    // /**
    //  * @return Role[] Returns an array of Role objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Role
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
