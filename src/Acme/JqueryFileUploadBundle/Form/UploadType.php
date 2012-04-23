<?php

namespace Acme\JqueryFileUploadBundle\Form;

use Acme\JqueryFileUploadBundle\Entity\Item;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
//            ->add('itemCode', 'text',
//                array(
//                    'label' => '商品番号',
//                    'required' => true,
//                    'pattern' => '^[0-9a-zA-Z][-_0-9a-zA-Z]{0,19}$',
//                ))
            ->add('itemPicture', 'file',
                array(
                    'label' => '商品画像',
                    'required' => false,
                    'attr' => array('style' => 'display:none;'),
                ))
        ;
    }

    public function getName()
    {
        return 'doyouphp_jp_uploadtype';
    }
}
