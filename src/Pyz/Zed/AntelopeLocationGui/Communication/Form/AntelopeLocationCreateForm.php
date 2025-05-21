<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class AntelopeLocationCreateForm extends AbstractType
{
    public const string FIELD_LOCATION_NAME = 'location_name';

    public function getBlockPrefix(): string
    {
        return 'antelope_location';
    }

    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void
    {
        $this->addLocationNameField($builder);
    }

    protected function addLocationNameField(FormBuilderInterface $builder): static
    {
        $builder->add(static::FIELD_LOCATION_NAME, TextType::class, [
            'label' => 'Location Name',
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
}
