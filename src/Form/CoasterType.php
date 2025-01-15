<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Coaster;
use App\Entity\Park;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Countries;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Validator\Constraints\Image;

class CoasterType extends AbstractType
{
    public function __construct(
        private readonly AuthorizationCheckerInterface $authorizationChecker
    ) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', options: [
                'label' => 'Nom du coaster',
            ])
            ->add('maxSpeed')
            ->add('length')
            ->add('maxHeight')
            ->add('operating')
            ->add('park', EntityType::class, [
                'class' => Park::class,
                'required' => false,
                'group_by' => function(Park $entity) {
                    return Countries::getName($entity->getCountry(), 'Fr_fr');
                }
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC')
                    ;
                }
            ])

            // ->add('imageFileName')
            ->add('image', FileType::class, [
                'label' => 'Photo du coaster',
                'help' => 'Fichier image d\'au moins 800x600',
                'mapped' => false, // Ne pas appeler la méthode getImage de l'entité Coaster
                'required' => false,
                'constraints' => [
                    // Symfony\Component\Validator\Constraints\Image
                    new Image(
                        maxSize: '2M',
                        minWidth: 800,
                        minHeight: 600,
                    ),
                ]
            ])
        ;

        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $builder->add('published', options: [
                'label' => 'Publier',
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coaster::class, // Coaster::class = "App\Entity\Coaster"
        ]);
    }
}
