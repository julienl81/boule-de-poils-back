<?php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Animal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animal[]    findAll()
 * @method Animal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Animal $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Animal $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    public function findAnimalsFromSearchForm($genderMin, $genderMax, $species, $ageMin, $ageMax, $child_compatibility, $other_animal_compatibility, $garden_needed, $status, $department)
    {
        $query = $this->createQueryBuilder('a');

            if ($child_compatibility == 0) {
                $query->andWhere('a.child_compatibility >= :child_compatibility');
            }
            else {
                $query->andWhere('a.child_compatibility = :child_compatibility');
            }

            if ($other_animal_compatibility == 0) {
                $query->andWhere('a.other_animal_compatibility >= :other_animal_compatibility');
            }
            else {
                $query->andWhere('a.other_animal_compatibility = :other_animal_compatibility');
            }

            if ($garden_needed == 0) {
                $query->andWhere('a.garden_needed >= :garden_needed');
            }
            else {
                $query->andWhere('a.garden_needed = :garden_needed');
            }
            
            if ($department == 0) {
                $query->andWhere('a.department >= :department');
            }
            else {
                $query->andWhere('a.department = :department');
            }

            $query->andWhere('a.species = :species');
            $query->andWhere('a.gender BETWEEN :gender_min AND :gender_max');
            $query->andWhere('a.age BETWEEN :age_min AND :age_max');
            $query->andWhere('a.status BETWEEN 0 AND :status');
            
            $query->setParameters(array(
            'species' => $species, 
            'gender_min' => $genderMin, 
            'gender_max' => $genderMax, 
            'age_min' => $ageMin, 
            'age_max' => $ageMax, 
            'child_compatibility' => $child_compatibility, 
            'other_animal_compatibility' => $other_animal_compatibility, 
            'garden_needed' => $garden_needed, 
            'status' => $status,
            'department' => $department
        ));

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Animal[] Returns an array of Animal objects
    //  */
    // public function findAnimalsFromSearchForm($genderMin, $genderMax, $species, $ageMin, $ageMax, $child_compatibility, $other_animal_compatibility, $garden_needed, $status, $department)
    // {
    //     $entityManager = $this->getEntityManager();

    //     $query = $entityManager->createQuery(
    //         'SELECT a
    //         FROM App\Entity\Animal a
    //         WHERE 
    //             a.species = :species AND 
    //             a.gender BETWEEN :gender_min AND :gender_max AND 
    //             a.child_compatibility = :child_compatibility AND 
    //             a.other_animal_compatibility = :other_animal_compatibility AND 
    //             a.garden_needed = :garden_needed AND 
    //             a.age BETWEEN :age_min AND :age_max AND
    //             a.department = :department AND
    //             a.status BETWEEN 0 AND :status  
    //         ORDER BY a.name ASC'
    //     )
    //     // Todo - Voir pour filtrer age_min et age_max avec < & >
    //     ->setParameters(array(
    //         'species' => $species, 
    //         'gender_min' => $genderMin, 
    //         'gender_max' => $genderMax, 
    //         'age_min' => $ageMin, 
    //         'age_max' => $ageMax, 
    //         'child_compatibility' => $child_compatibility, 
    //         'other_animal_compatibility' => $other_animal_compatibility, 
    //         'garden_needed' => $garden_needed, 
    //         'status' => $status,
    //         'department' => $department
    //     ));
 
    //     return $query->getResult();

    //     //
        
    // }

    

    /**
     * @return Animal[] Returns an array of Animal objects
     */
    public function findAnimalsForCaroussel()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a.id, a.imageName, a.name, a.description
            FROM App\Entity\Animal a
            '
        )
        //->setMaxResults(10)
        ;

        return $query->getResult();
    }
    
    
    // return $this->createQueryBuilder('a')
    //     ->andWhere('a.exampleField = :val')
    //     ->setParameter('val', $value)
    //     ->orderBy('a.id', 'ASC')
    //     ->setMaxResults(10)
    //     ->getQuery()
    //     ->getResult()

    // ;
        // public function findAllAnimals()
    // {
    //     return $this->createQueryBuilder('a')
    //         ->orderBy('a.id', 'ASC')
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }


    // /**
    //  * @return Animal[] Returns an array of Animal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Animal
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
