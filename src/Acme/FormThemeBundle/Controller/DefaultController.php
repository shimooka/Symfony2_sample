<?php

namespace Acme\FormThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $form = $this->createFormBuilder()
            ->add('name', 'text', [
                'label' => '名前',
                'attr' => [
                    'foo' => 'bar'
                ],
            ])
            ->add('gender', 'choice', [
                'label' => '性別',
                'required' => true,
                'choices' => [          // 選択肢
                    0 => '女性',
                    1 => '男性'
                ],
                'data' => 0,            // 初期データ
                'expanded' => true,     // radioボタンにするための設定
                'multiple' => false,    // radioボタンにするための設定
                'attr' => [
                    'foo' => 'bar'
                ],
            ])
            ->add('items', 'choice', [
                'label' => '項目',
                'required' => true,
                'choices' => [          // 選択肢
                    0 => 'foo',
                    1 => 'bar',
                    2 => 'baz'
                ],
                'expanded' => true,     // checkboxボタンにするための設定
                'multiple' => true,     // checkboxボタンにするための設定
                'attr' => [
                    'foo' => 'bar'
                ],
            ])
            ->getForm();

        return [
            'form' => $form->createView()
        ];
    }
}
