<?php

namespace App\Controller;

use Twig\Environment;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersList
{
    public function __invoke(Environment $twig, OrderRepository $orderRepository): Response 
    {

        $list = $orderRepository->findAll();

        return new Response(
            $twig->render('orders/ordersList.html.twig',
                [
                    'orders' => $list
                ]
            )
        );
    }
}