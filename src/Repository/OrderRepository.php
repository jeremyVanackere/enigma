<?php
namespace App\Repository;

use App\Entity\Order;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class OrderRepository extends ServiceEntityRepository {
    
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Order::class);
    }

    public function save(Order $order): void {
        $this->getEntityManager()->flush($order);
    }

    public function persistAndSave(Order $order): void {
        $this->getEntityManager()->persist($order);
        $this->save($order);
    }
}