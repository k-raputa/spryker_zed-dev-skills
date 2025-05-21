<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeGui\Communication\Form;

use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AntelopeCreateForm extends AbstractType
{
    public const string FIELD_NAME = 'name';
    public const string FIELD_ANTYLOPE_LOCATION_ID = AntelopeTransfer::FK_ANTELOPE_LOCATION;

    public const string OPTION_ANTYLOPE_LOCATION_CHOICES = 'location_choices';

    public function getBlockPrefix(): string
    {
        return 'antelope';
    }

    /**
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setRequired(static::OPTION_ANTYLOPE_LOCATION_CHOICES);
    }

    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void
    {
        $this->addNameField($builder);
        $this->addLocationField($builder, $options);
    }

    protected function addNameField(FormBuilderInterface $builder): static
    {
        $builder->add(static::FIELD_NAME, TextType::class, [
            'label' => 'Name',
            'constraints' => [
                $this->createNotBlankConstraint(),
            ],
        ]);

        return $this;
    }

    protected function createNotBlankConstraint(): NotBlank
    {
        return new NotBlank();
    }

    protected function addLocationField(FormBuilderInterface $builder, $options): static
    {
        $builder->add(static::FIELD_ANTYLOPE_LOCATION_ID, ChoiceType::class, [
            'label' => 'Antylope Location',
            'required' => true,
            'choices' => $options[static::OPTION_ANTYLOPE_LOCATION_CHOICES],
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        return $this;
    }
}
