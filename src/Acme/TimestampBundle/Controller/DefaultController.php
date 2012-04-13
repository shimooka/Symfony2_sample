<?php

namespace Acme\TimestampBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\AbstractType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\TimestampBundle\Form\TimestampsType;
use Acme\TimestampBundle\Form\TimestampsConstraintType;
use Acme\TimestampBundle\Form\TimestampsRegexType;
use Acme\TimestampBundle\Entity\Timestamps;
use Acme\TimestampBundle\Entity\TimestampsConstraint;
use Acme\TimestampBundle\Entity\TimestampsRegex;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="acme_timestampbundle_index")
     * @Template()
     */
    public function indexAction()
    {
        return $this->doStuff(new Timestamps(), new TimestampsType());
    }

    /**
     * @Route("/regex", name="acme_timestampbundle_regex")
     * @Template("AcmeTimestampBundle:Default:index.html.twig")
     */
    public function regexAction()
    {
        return $this->doStuff(new TimestampsRegex(), new TimestampsRegexType());
    }

    /**
     * @Route("/constraint", name="acme_timestampbundle_constraint")
     * @Template("AcmeTimestampBundle:Default:index.html.twig")
     */
    public function constraintAction()
    {
        return $this->doStuff(new TimestampsConstraint(), new TimestampsConstraintType());
    }

    private function doStuff($entity, AbstractType $formType)
    {
        $message = null;
        $form = $this->createForm($formType, $entity);
        if ('POST' === $this->getRequest()->getMethod()) {
            $form->bindRequest($this->getRequest());
            if ($form->isValid()) {
                try {
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($entity);
                    $em->flush();
                    $message = '登録しました';
                } catch (\PDOException $e) {
                    $message = '登録できませんでした:' . $e->getMessage();
                }
            }
        }

        return array(
            'form' => $form->createView(),
            'message' => $message,
        );
    }

}
