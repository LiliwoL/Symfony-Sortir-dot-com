<?php

namespace App\Form;



use App\Entity\Site;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifierProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('prenom')
            ->add('nom')
            ->add('telephone')
            ->add('courriel')
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'required' => false,
            ])
            ->add('confirmPassword', PasswordType::class, [
                'mapped' => false,
                'required' => false,
            ])
           ->add('site',EntityType::class, [
                'class' => Site::class,
                'choice_label' => 'nom',
               'multiple'=>false,
               'expanded'=>false
           ])
            /*
            ->add('site',EntityType::class, [
                'class' => Site::class,
                'choice_label' => function(?Site $site) {
                    return $site ? $this->getNomSite($site) : '';
                },
                'multiple'=>false,
                'expanded'=>false
            ])
            */
            ->add('nomPhoto')
            ->add('Enregistrer' , SubmitType::class)
            ->add('Annuler' , SubmitType::class)
        ;
    }
    /*
    public function getNomSite(?Site $site) {
        $lieuRepository = LieuRepository;
        return $lieuRepository->findBy(['id' => $site->getLocalisation()]);
    }
    */

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
