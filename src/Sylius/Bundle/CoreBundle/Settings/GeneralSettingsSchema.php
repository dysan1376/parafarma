<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CoreBundle\Settings;

use Sylius\Bundle\SettingsBundle\Schema\SchemaInterface;
use Sylius\Bundle\SettingsBundle\Schema\SettingsBuilderInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Currency;
use Symfony\Component\Validator\Constraints\Locale;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * General settings schema.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class GeneralSettingsSchema implements SchemaInterface
{
    /**
     * @var array
     */
    protected $defaults;

    /**
     * @param array $defaults
     */
    public function __construct(array $defaults = array())
    {
        $this->defaults = $defaults;
    }

    /**
     * {@inheritdoc}
     */
    public function buildSettings(SettingsBuilderInterface $builder)
    {
        $builder
            ->setDefaults(array_merge(array(
                'title'            => 'parafar.me',
                'meta_keywords'    => 'farmacia, online, carrito, medicina, medico, salud, hospital',
                'meta_description' => 'parafar.me - farmacia on-line',
                'locale'           => 'es_EC',
                'currency'         => 'USD',
                'tracking_code'    => '',
            ), $this->defaults))
            ->setAllowedTypes(array(
                'title'            => array('string'),
                'meta_keywords'    => array('string'),
                'meta_description' => array('string'),
                'locale'           => array('string'),
                'currency'         => array('string'),
                'tracking_code'    => array('null', 'string'),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('title', 'text', array(
                'label'       => 'sylius.form.settings.general.title',
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('meta_keywords', 'text', array(
                'label'       => 'sylius.form.settings.general.meta_keywords',
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('meta_description', 'textarea', array(
                'label'       => 'sylius.form.settings.general.meta_description',
                'constraints' => array(
                    new NotBlank()
                )
            ))
            ->add('locale', 'locale', array(
                'label'       => 'sylius.form.settings.general.locale',
                'constraints' => array(
                    new NotBlank(),
                    new Locale(),
                )
            ))
            ->add('currency', 'sylius_currency_choice', array(
                'label'       => 'sylius.form.settings.general.currency',
                'constraints' => array(
                    new NotBlank(),
                    new Currency(),
                )
            ))
            ->add('tracking_code', 'textarea', array(
                'label'       => 'sylius.form.settings.general.tracking_code',
            ))
        ;
    }
}
