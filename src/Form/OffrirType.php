<?php

namespace App\Form;

use App\Entity\Medicament;
use App\Entity\Offrir;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class OffrirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('off_qte', IntegerType::class, [
                'attr' => [
                    'placeholder' => "Quantité"
                ]
            ])
            ->add('medicament', EntityType::class, [
                'class' => Medicament::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offrir::class,
        ]);
    }
}
