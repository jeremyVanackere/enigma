<?php


namespace App\Tests\Controller;


use App\Controller\OrdersDetail;
use App\Entity\Order;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class OrderDatailTest extends TestCase
{
    public function testInvoke() : void {
        $orderDetail = new OrdersDetail();
        $orderProphecy = $this->prophesize(Order::class);
        $twigProphecy = $this->prophesize(Environment::class);
        $orderReveal = $orderProphecy->reveal();
        $twigProphecy->render('orders/ordersDetail.html.twig',['order' => $orderReveal])->shouldBeCalled();

        $response = $orderDetail($twigProphecy->reveal(),$orderReveal);

        $this->assertInstanceOf(Response::class, $response);
    }
}