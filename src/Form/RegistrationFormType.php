<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => false,
                'attr' => array(
                    'class' => 'form-control mt-3',
                    'placeholder' => 'Login',
                    ),
                ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'attr' => array('class' => 'form-control'),
                'type' => PasswordType::class,
                'invalid_message' => 'Hasła nie są identyczne',
                'required' => true,
                'first_options'  => [
                    'label' => false,
                    'attr' => array(
                        'class' => 'form-control mt-3',
                        'placeholder' => 'Hasło',
                    )],
                'second_options' => [
                    'label' => false,
                    'attr' => array(
                        'class' => 'form-control mt-3',
                        'placeholder' => 'Powtórz hasło',
                    )],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Nie wpisano hasła',
                    ])
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
