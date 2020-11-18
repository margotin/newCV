<?php

namespace App\Form;

use App\Entity\Portfolio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PortfolioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'label' => "Titre"
            ])
            ->add('image', FileType::class,[
                'label' => "Image du site",
                'data_class' => null,
                'required' => false,
                'mapped' => false,
                'help' => 'Laisser vide si image non modifiée'
            ])
            ->add('usedTechnologies', TextType::class,[
                'label' => "Technologies utilisées"
            ])
            ->add('createdAt', DateType::class, [
                'label' => 'Date de création',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'MMMM yyyy',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('siteUrl', TextType::class,[
                'label' => "URL du site"
            ])
            ->add('githubUrl', TextType::class,[
                'label' => "Github",
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Portfolio::class,
        ]);
    }
}
