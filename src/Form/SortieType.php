<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Entity\Sortie;
use App\Entity\Lieu;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('description', TextType::Class)
            ->add('organisateur', EntityType::Class,
                [
                    'class' => Utilisateur::class,
                    'choice_label' => 'username',
                    'mapped'=> true,
                    'multiple' => false,

                ])
            ->add('nbInscriptionMax', TextType::Class)
            ->add('adresse', EntityType::class,
                [
                    'class' => Lieu::class,
                    'choice_label' => 'nom',

                ])
            ->add('date_enregistrement', DateTimeType::class)
            ->add('date_ouverture_inscription', DateTimeType::class )
            ->add('date_fermeture_inscription', DateTimeType::class)
            ->add('isAnnulee')
            ->add('date_debut_sortie', DateTimeType::class)
            ->add('date_fin_sortie', DateTimeType::class )

        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
