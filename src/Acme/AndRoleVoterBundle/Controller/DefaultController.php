<?php

namespace Acme\AndRoleVoterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}", name="hello")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/user/{name}", name="user")
     * @Template()
     */
    public function userAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/private/{name}", name="private")
     * @Template()
     */
    public function privateAction($name)
    {
        return array('name' => $name);
    }
}
