<?php

namespace App\Form;

use App\Entity\Association;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssociationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de l\'association',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ])
            ->add('siren', null, [
                'label' => 'Numéro de SIREN',
            ])
            ->add('address', null, [
                'label' => 'Numéro et voie',
            ])
            ->add('zip_code', null, [
                'label' => 'Code postal',
            ])
            ->add('city', null, [
                'label' => 'Ville',
            ])
            ->add('phone_number', null, [
                'label' => 'Téléphone',
                // TODO - Peut-être ajouter un champs pour préciser "facultatif"
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('active', null, [
                'label' => 'Active ?',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Association::class,
        ]);
    }
}
