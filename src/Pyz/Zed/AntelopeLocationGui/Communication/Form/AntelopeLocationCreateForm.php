<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationGui\Communication\Form;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @method \Pyz\Zed\AntelopeLocationGui\AntelopeLocationGuiConfig getConfig()
 * @method \Pyz\Zed\AntelopeLocationGui\Communication\AntelopeLocationGuiCommunicationFactory getFactory()
 */
class AntelopeLocationCreateForm extends AbstractType
{
    private const string COL_LOCATION_NAME = AntelopeLocationTransfer::LOCATION_NAME;

    private const string SAVE_BTN = 'save';

    /**
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(self::COL_LOCATION_NAME, TextType::class, [
                'label' => 'Location Name',
                'constraints' => [new NotBlank()],
            ])
            ->add(self::SAVE_BTN, SubmitType::class, [
                'label' => 'Create Location',
            ]);
    }
}
