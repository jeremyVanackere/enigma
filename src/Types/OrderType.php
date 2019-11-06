<?php
namespace App\Types;

use App\Entity\Order;
use App\Types\SelectType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class OrderType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $option) {
        $builder
            ->add('name')
            ->add('status', ChoiceType::class, [
                'choices' => \array_combine(Order::STATUSES, Order::STATUSES)
            ])
            ->add('selections', CollectionType::class, [
                'entry_type' => SelectType::class,
                'allow_add' => true,
                'prototype' => true,
                'by_reference' => false
            ])
            ->add('submit', SubmitType::class);
    }
}