<?php

namespace App\Form;

use App\Entity\Card;
use App\Entity\User;
use App\Entity\Faction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Form\Type\HiddenType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nom')
            ->add('atk')
            ->add('hp')
            ->add('cost')
            ->add('id_faction',
                  EntityType::class, [
                      'class' => Faction::class,
                      'choice_label' => function(Faction $faction){
                        return $faction->getNom();
                      },
                  ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Card::class,
        ]);
    }
}
