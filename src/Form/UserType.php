<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('Roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                  'User' => 'ROLE_USER',
                  'Partner' => 'ROLE_PARTNER',
                  'Admin' => 'ROLE_ADMIN',
                ],
            ])
            ->add('password')
            ->add('Phone')
        ;
        $builder->get('Roles')
    ->addModelTransformer(new CallbackTransformer(
        function ($rolesArray) {
             // transform the array to a string
             return count($rolesArray)? $rolesArray[0]: null;
        },
        function ($rolesString) {
             // transform the string back to an array
             return [$rolesString];
        }
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
