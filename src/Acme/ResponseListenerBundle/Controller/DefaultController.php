<?php

namespace Acme\ResponseListenerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function defaultAction()
    {
        /**
         * indexActionの$_formatにデフォルト値を設定しているため、
         * nameだけ指定している
         */
        return $this->forward(
            'AcmeResponseListenerBundle:Default:index',
            array('name' => 'ResponseListenerBundle'));
    }

    /**
     * @see http://docs.symfony.gr.jp/symfony2/quick_tour/the_controller.html
     *
     * 多段に分けてもOKっぽい
     * @Route(
     *     "/hello/{name}.{_format}",
     *     defaults=    {"_format" = "html"},
     *     requirements={"_format"="html|xml|json|csv"},
     *     name=        "ResponseListenerBundle_hello"
     * )
     * @Template()
     */
    public function indexAction($name, $_format = 'html')
    {
        return array('name' => $name);
    }
}
