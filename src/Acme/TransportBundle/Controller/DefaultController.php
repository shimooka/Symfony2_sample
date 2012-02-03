<?php

namespace Acme\TransportBundle\Controller;

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
        $services = array();
        foreach ($this->get('transport_chain')->getTransports() as $service) {
            $services[] = get_class($service);
        }
        return array('services' => $services);
    }
}
