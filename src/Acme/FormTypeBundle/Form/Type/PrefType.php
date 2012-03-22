<?php

namespace Acme\FormTypeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\FormTypeBundle\Form\DataTransformer\PrefToIdTransformer;

/**
 * 都道府県FormType
 *
 * services.ymlで以下のように定義
 *
 * services:
 *     form.type.pref:
 *         class: Acme\FormTypeBundle\Form\Type\PrefType
 *         arguments:
 *             - @doctrine.orm.entity_manager
 *         tags:
 *             - { name: form.type, alias: pref }
 *
 * @version $Id$
 */
class PrefType extends AbstractType
{
    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function getDefaultOptions(array $options)
    {
        $prefs = $this->om->getRepository('AcmeFormTypeBundle:MPref')
                            ->createQueryBuilder('a')
                            ->where("a.deleteFlag = '0' ")
                            ->orderBy("a.id ")
                            ->getQuery()->execute();
        $choices = array();
        foreach ($prefs as $pref) {
            $choices[$pref->getId()] = $pref->getPrefName();
        }

        return array(
            'choices' => $choices,
            'label' => '都道府県',
            'empty_value' => '選択してください',
            'property' => 'prefName',
            'multiple' => false,
            'expanded' => false,
        );
    }

    public function getName()
    {
        return 'acme_formtypebundle_preftype';
    }

    public function getParent(array $options)
    {
        return 'choice';
    }
}
