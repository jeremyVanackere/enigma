<?php

namespace App\Controller;

use App\Entity\Order;
use Twig\Environment;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersDetail
{
    public function __invoke(Environment $twig, Order $order): Response 
    {
        return new Response(
            $twig->render('orders/ordersDetail.html.twig',[
                'order' => $order
            ])
        );
    }
}