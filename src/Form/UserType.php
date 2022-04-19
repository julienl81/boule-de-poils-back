<?php

namespace App\Form;

use App\Entity\Association;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', null, [
                'label' => 'Pseudo',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('password', null, [
                'label' => 'Mot de passe',
            ])
            ->add('active', null, [
                'label' => 'Statut actif ?',
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Rôle(s)',
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Association' => 'ROLE_ASSOCIATION',
                    'Utilisateur' => 'ROLE_USER',
                ],
                'multiple' => true,
                'expanded' => true,
                ])
            ->add('association', EntityType::class, 
            [
                'label' => 'Association',
                'class' => Association::class,
                'choice_label' => 'name',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
