<?php

namespace App\Form;

use App\Entity\Home;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Qualités'
            ])
            ->add('image', FileType::class, [
                'label' => "Photo portrait",
                'data_class' => null,
                'required' => false,
                'mapped' => false,
                'help' => 'Laisser vide si image non modifiée'
            ])
            ->add('content', CKEditorType::class,[
                'config_name' => 'presentation'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Home::class,
        ]);
    }
}
