<?php

namespace App\Form;

use App\Entity\Medicament;
use App\Entity\Offrir;
use App\Entity\Praticien;
use App\Entity\RapportVisite;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
        $this->getConfiguration('Numéro: ', "Veuillez saisir le numéro")
        )
        ->add('rap_date', 
            DateType::class,[
            'widget' => 'single_text',
            'label' => 'Date de visite: '
        ])
        ->add('praticien', EntityType::class, [
            'class' => Praticien::class,
            'choice_label' =>  'nom' 
        ])
        ->add('rap_motif', EntityType::class, [
            'class' => RapportVisite::class,
            'choice_label' =>  'rap_motif',
            'label' => 'Motif: '

        ])
        ->add('rap_bilan', 
        TextareaType::class,
        $this->getConfiguration("Bilan: ", "Donner le bilan détaillé")
        )
        ->add('offrirs', EntityType::class, [
            'class' => Medicament::class,
            'choice_label' => 'libelle',
            'label' => 'Produit: '
        ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
