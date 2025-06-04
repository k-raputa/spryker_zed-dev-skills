<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeGui\Communication\Form;

use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @method \Pyz\Zed\AntelopeGui\AntelopeGuiConfig getConfig()
 * @method \Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory getFactory()
 */
class AntelopeCreateForm extends AbstractType
{
    public const string FIELD_NAME = 'name';

    public const string FIELD_ID_LOCATION = AntelopeTransfer::FK_ANTELOPE_LOCATION;

    public const string OPTION_LOCATION_CHOICES = 'location_choices';

    /**
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setRequired(static::OPTION_LOCATION_CHOICES);
    }

    public function getBlockPrefix(): string
    {
        return 'antelope';
    }

    /**
     * @return void
     */
    public function buildForm(
        FormBuilderInterface $builder,
        array $options,
    ): void {
        $this->addNameField($builder)->addIdLocationField($builder, $options);
    }

    protected function addIdLocationField(FormBuilderInterface $builder, array $options): static
    {
        $builder->add(static::FIELD_ID_LOCATION, ChoiceType::class, [
            'label' => 'Location',
            'required' => true,
            'choices' => $options[static::OPTION_LOCATION_CHOICES],
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        return $this;
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
}
