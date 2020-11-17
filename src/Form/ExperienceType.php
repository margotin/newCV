<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Intitulé du poste"
            ])
            ->add('location', TextType::class, [
                'label' => "Lieu"
            ])
            ->add('company', TextType::class, [
                'label' => "Nom de l'entreprise"
            ])
            ->add('startAt', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'MMMM yyyy',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('endAt', DateType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'MMMM yyyy',
                "required" => false,
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('works', CollectionType::class, [
                'label' => 'Travail effectué',
                'entry_type' => TextType::class,
                'allow_add' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
