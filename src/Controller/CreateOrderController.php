<?php

namespace App\Controller;

use App\Entity\Order;
use Twig\Environment;
use App\Types\OrderType;
use App\Entity\Selection;
use App\Types\SelectType;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateOrderController
{
    /**
     * @Route("/orders/create", name="create_order", methods={"GET","POST"})
     */
    public function __invoke(Environment $twig, 
    FormFactoryInterface $formFactory, 
    Request $request, 
    OrderRepository $orderRepository,
    RouterInterface $router)
    {
        $order = new Order();
        $form = $formFactory->create(OrderType::class, $order);

        $form->handleRequest($request);
        try {
            if($form->isValid()) {
                $order = $form->getData();
                $orderRepository->persistAndSave($order);

                return new RedirectResponse(
                    $router->generate('orders_list')
                ); 
            }
        } catch(\LogicException $e) {
            // rien
        }

        return new Response(
            $twig->render('orders/ordersCreate.html.twig', [
                'form' => $form->createView()
            ])
        );
    }
}
