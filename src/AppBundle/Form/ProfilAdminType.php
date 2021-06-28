<?php
namespace AppBundle\Form;
use AppBundle\Entity\Usr;
use AppBundle\Entity\Activite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ProfilAdminType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('name',TextType::class, array('label' => 'Prénom '))
        ->add('lastname',TextType::class, array('label' => 'Nom '))
        ->add('email')
        ->add('username',TextType::class, array('label' => "Nom D'utilisateur"))
        ->add('activite',EntityType::class, [
                'class' => Activite::class,
                'choice_label' => function(Activite $act) {
                    return sprintf('%s',  $act->getActivite());
                },
                'label' => 'Activité',
                'placeholder' => 'sélectionner un service'
            ]);







    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usr'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
