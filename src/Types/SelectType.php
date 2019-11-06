<?php
namespace App\Types;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Selection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SelectType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $option) {
        $builder
            ->add('quantity', IntegerType::class)
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Selection::class,
        ]);
    }
}