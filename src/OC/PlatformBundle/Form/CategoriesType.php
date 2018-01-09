<?php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use OC\PlalatformBundle\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use OC\PlalatformBundle\Form\CategoriesTranslatesType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class CategoriesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('Pseudo',TextType::class)
                ->add('nomFichier', TextType::class)
                ->add('specialite',ChoiceType::class,array('choices'=>array('Mathématique'=>'Maths','Informatique'=>'Info','Biologie'=>'Bio','Physique'=>'Phys','Chimie'=>'Chimie')))
                ->add('imageFile', FileType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\PlatformBundle\Entity\Categories'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'PlatformBundle_categories';
    }


}
