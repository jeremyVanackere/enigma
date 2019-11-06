<?php
namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderUpdateStatus {

    public function __invoke(Order $order, $status,
     OrderRepository $repo, 
     RouterInterface $router,
     ValidatorInterface $validator,
     Session $session)
    {
        $order->setStatus($status);
        $constraintViolationList = $validator->validate($order);
        
        $flashbag = $session->getFlashBag();

        if(!$constraintViolationList->count()) {
            $flashbag->add('success', 'Status mis à jour avec succès.');
            $repo->save($order);
            return new RedirectResponse(
                $router->generate('orders_detail', ['id'=> $order->getNumber()])
            );
        }

        foreach ($constraintViolationList as $violation) {
            $flashbag->add('error', $violation->getMessage());
        }
        return new RedirectResponse(
            $router->generate('orders_detail', ['id'=> $order->getNumber()])
        );
    }
}