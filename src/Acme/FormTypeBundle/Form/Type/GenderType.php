<?php

namespace Acme\FormTypeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

/**
 * 性別FormType
 *
 * services.ymlで以下のように定義
 *
 * services:
 *     form.type.gender:
 *         class: Acme\FormTypeBundle\Form\Type\GenderType
 *         arguments:
 *             - @doctrine.orm.entity_manager
 *         tags:
 *             - { name: form.type, alias: gender }
 *
 * @version $Id$
 */
class GenderType extends AbstractType
{
    private $genderChoices;

    public function __construct(array $genderChoices)
    {
        $this->genderChoices = $genderChoices;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'choices' => $this->genderChoices
        );
    }

    public function getName()
    {
        return 'acme_formtypebundle_gendertype';
    }

    public function getParent(array $options)
    {
        return 'choice';
    }
}