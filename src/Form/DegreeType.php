<?php

namespace App\Form;

use App\Entity\Degree;
use App\Entity\School;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DegreeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du diplome'
            ])
            ->add('location', TextType::class, [
                'label' => 'Lieu de la formation'
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
            ->add('school', EntityType::class, [
                'label' => 'École',
                'class' => School::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Degree::class
        ]);
    }
}
