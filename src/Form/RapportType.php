<?php

namespace App\Form;

use App\Entity\Offrir;
use App\Form\OffrirType;
use App\Entity\Praticien;
use App\Entity\Medicament;
use App\Entity\RapportVisite;
use App\Entity\Visiteur;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RapportType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('id', IntegerType::class, 
        $this->getConfiguration('Numéro: ', "Veuillez saisir le numéro",[
            'required' => false
        ]
        ))
        ->add('rap_date', 
            DateType::class,[
            'widget' => 'single_text',
            'label' => 'Date de visite: '
        ])
        ->add('praticien', EntityType::class, [
            'class' => Praticien::class,
            'choice_label' =>  'FullName',
            'required'   => false
        ])
        
        ->add('visiteur', EntityType::class,[
            'class' => Visiteur::class,
            'choice_label' => 'FullName',
            'required'   => false
        ]) 

        ->add('rap_motif', ChoiceType::class, [
            'choices' => [
                'Périodicité' => 'Périodicité',
                'Actualisation' => 'Actualisation',
                'Relance' => 'Relance',
                'Autre' => 'Autre'
            ],
            'label' => 'Motif: ',
            'required'   => false

        ])
        ->add('rap_bilan', 
        TextareaType::class,
        $this->getConfiguration("Bilan: ", "Donner le bilan détaillé")
        )
        /*->add('offrirs', EntityType::class, [
            'class' => Medicament::class,
            'choice_label' => 'libelle',
            'label' => 'Produit: '
        ])*/
        ->add('offrirs', CollectionType::class, 
        [
            'entry_type' => OffrirType::class,
            'allow_add' => true
            
            
        ]
        )
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
