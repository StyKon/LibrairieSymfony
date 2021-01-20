<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('nbPages')
            ->add('dateEdition', DateType::class, array(
                'format' => 'yyyy-MM-dd', 
                'widget' => 'single_text', 
            ))
            ->add('nbExemplaires')
            ->add('prix')
            ->add('isbn')
            ->add('Editeur')
            ->add('Categorie')
            ->add('Auteur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
