<?php

namespace App\Form;

use App\Entity\Appartement;
use App\Entity\Agence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;


class AppartementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresse')
            ->add('complement')
            ->add('ville')
            ->add('code_postal')
            ->add('prix_charges')
            ->add('prix_loyer')
            ->add('superficie')
            ->add('prix_depot_garantie')
            ->add('agence', EntityType::class, [
                'required' => true,
                'label' => 'Choisir une agence',
                'class' => Agence::class,
                'choice_label' => 'nom_agence',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir une agence'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appartement::class,
        ]);
    }
}