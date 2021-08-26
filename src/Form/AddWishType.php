<?php

namespace App\Form;

use App\Entity\Wish;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddWishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'label' => 'Titre:'
            ])
            ->add('description', TextType::class,[
                'label' => 'Description:'
            ] )
            ->add('author', TextType::class,[
                'label' => 'Auteur:'
            ])
//            ->add('isPublished', CheckboxType::class, [
//                'label' => 'Publier?'
//            ])
//            ->add('dateCreated', DateTimeType::class, [
//                'label' => 'Date de création:',
//                'date_widget' => 'single_text',
//                'view_timezone' => 'Europe/Paris',
////                'data' => new \DateTime(),
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
