<?php

namespace Acme\FormTypeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\FormTypeBundle\Entity\Formtype;
use Acme\FormTypeBundle\Form\FormtypeType;
use Acme\FormTypeBundle\Form\FormtypeSearchType;

/**
 * Formtype controller.
 *
 * @Route("/formType")
 */
class FormtypeController extends Controller
{
    /**
     * Lists all Formtype entities.
     *
     * @Route("/", name="formType")
     * @Template()
     */
    public function indexAction()
    {
        $entities = array();
        $form     = $this->createForm(new FormtypeSearchType());
        $request  = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);
            $em = $this->getDoctrine()->getEntityManager();
            $entities = $em->getRepository('AcmeFormTypeBundle:Formtype')
                ->findBySearchForm($form->getData());
        }

        return array(
            'entities' => $entities,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Formtype entity.
     *
     * @Route("/{id}/show", name="formType_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeFormTypeBundle:Formtype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formtype entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Formtype entity.
     *
     * @Route("/new", name="formType_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Formtype();
        $form   = $this->createForm(new FormtypeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Formtype entity.
     *
     * @Route("/create", name="formType_create")
     * @Method("post")
     * @Template("AcmeFormTypeBundle:Formtype:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Formtype();
        $request = $this->getRequest();
        $form    = $this->createForm(new FormtypeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formType_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Formtype entity.
     *
     * @Route("/{id}/edit", name="formType_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeFormTypeBundle:Formtype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formtype entity.');
        }

        $editForm = $this->createForm(new FormtypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Formtype entity.
     *
     * @Route("/{id}/update", name="formType_update")
     * @Method("post")
     * @Template("AcmeFormTypeBundle:Formtype:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeFormTypeBundle:Formtype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formtype entity.');
        }

        $editForm   = $this->createForm(new FormtypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formType_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Formtype entity.
     *
     * @Route("/{id}/delete", name="formType_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('AcmeFormTypeBundle:Formtype')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Formtype entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('formType'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
