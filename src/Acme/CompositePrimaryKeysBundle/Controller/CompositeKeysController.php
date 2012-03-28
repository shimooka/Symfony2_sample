<?php

namespace Acme\CompositePrimaryKeysBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\CompositePrimaryKeysBundle\Entity\CompositeKeys;
use Acme\CompositePrimaryKeysBundle\Form\CompositeKeysType;
use Acme\CompositePrimaryKeysBundle\Form\CompositeKeysSearchType;

/**
 * CompositeKeys controller.
 *
 * @Route("/compositeKeys")
 */
class CompositeKeysController extends Controller
{
    const MESSAGE_KEY = '_message';

    /**
     * Lists all CompositeKeys entities.
     *
     * @Route("/", name="compositeKeys")
     * @Template()
     */
    public function indexAction()
    {
        $form     = $this->createForm(new CompositeKeysSearchType());
        $message = $this->getMessage();
        $pagination = null;

        return array(
            'form'   => $form->createView(),
            'message'  => $message,
            'pagination'  => $pagination,
        );
    }

    /**
     * Lists all CompositeKeys entities.
     *
     * @Route("/list", name="compositeKeys_list")
     * @Template("AcmeCompositePrimaryKeysBundle:CompositeKeys:index.html.twig")
     */
    public function listAction()
    {
        $form     = $this->createForm(new CompositeKeysSearchType());
        $request  = $this->getRequest();
        $message = $this->getMessage();
        $pagination = null;

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);
            $request->getSession()->set('_search_form', $request->request->get($form->getName(), array()));
        } else {
            $form->bind($request->getSession()->get('_search_form', array()));
        }

        $repository = $this->getDoctrine()->getEntityManager()->getRepository('AcmeCompositePrimaryKeysBundle:CompositeKeys');
        $query = $repository->findBySearchForm($form->getData());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->get('p', 1),   // $request->query = $_GET
            2,                              // items per page
            array('distinct' => false)      // 複合主キーの場合は必須
        );

        return array(
            'form'   => $form->createView(),
            'message'  => $message,
            'pagination'  => $pagination,
        );
    }

    /**
     * Finds and displays a CompositeKeys entity.
     *
     * @Route("/{key1}/{key2}/show", name="compositeKeys_show")
     * @Template()
     */
    public function showAction($key1, $key2)
    {
        $request  = $this->getRequest();
        $message = $this->getMessage();

        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('AcmeCompositePrimaryKeysBundle:CompositeKeys')->find(array('key1' => $key1, 'key2' => $key2));

        if (!$entity) {
            $this->setErrorMessage('データが存在しません');
            return $this->redirect($this->generateUrl('compositeKeys'));
        }

        $deleteForm = $this->createDeleteForm($key1, $key2);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'message'     => $message,
        );
    }

    /**
     * Displays a form to create a new CompositeKeys entity.
     *
     * @Route("/new", name="compositeKeys_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CompositeKeys();
        $form   = $this->createForm(new CompositeKeysType(), $entity);
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'message' => null,
        );
    }

    /**
     * Creates a new CompositeKeys entity.
     *
     * @Route("/create", name="compositeKeys_create")
     * @Method("post")
     * @Template("AcmeCompositePrimaryKeysBundle:CompositeKeys:new.html.twig")
     */
    public function createAction()
    {
        $request  = $this->getRequest();
        $message = $this->getMessage();

        $entity  = new CompositeKeys();
        $form    = $this->createForm(new CompositeKeysType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            try {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();
                $this->setNoticeMessage('データを登録しました');
                return $this->redirect($this->generateUrl('compositeKeys_show', array('key1' => $entity->getKey1(), 'key2' => $entity->getKey2())));
            } catch (\PDOException $e) {
                $message = array('error' => 'エラーが発生しました');
                if ($e->getCode() === '23505') {    // \PDO::ERR_ALREADY_EXISTS
                    $message =  array('error' => 'すでに登録されています');
                }
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'message'  => $message,
        );
    }

    /**
     * Displays a form to edit an existing CompositeKeys entity.
     *
     * @Route("/{key1}/{key2}/edit", name="compositeKeys_edit")
     * @Template()
     */
    public function editAction($key1, $key2)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('AcmeCompositePrimaryKeysBundle:CompositeKeys')->find(array('key1' => $key1, 'key2' => $key2));

        if (!$entity) {
            $this->setErrorMessage('データが存在しません');
            return $this->redirect($this->generateUrl('compositeKeys'));
        }

        $editForm = $this->createForm(new CompositeKeysType(), $entity);
        $deleteForm = $this->createDeleteForm($key1, $key2);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'message'     => $this->getMessage(),
        );
    }

    /**
     * Edits an existing CompositeKeys entity.
     *
     * @Route("/{key1}/{key2}/update", name="compositeKeys_update")
     * @Method("post")
     * @Template("AcmeCompositePrimaryKeysBundle:CompositeKeys:edit.html.twig")
     */
    public function updateAction($key1, $key2)
    {
        $request  = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('AcmeCompositePrimaryKeysBundle:CompositeKeys')->find(array('key1' => $key1, 'key2' => $key2));

        if (!$entity) {
            $this->setErrorMessage('データが存在しません');
            return $this->redirect($this->generateUrl('compositeKeys'));
        }

        $editForm   = $this->createForm(new CompositeKeysType(), $entity);
        $deleteForm = $this->createDeleteForm($key1, $key2);

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->setNoticeMessage('データを更新しました');
            return $this->redirect($this->generateUrl('compositeKeys_edit', array('key1' => $key1, 'key2' => $key2)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'message'     => $this->getMessage(),
        );
    }

    /**
     * Deletes a CompositeKeys entity.
     *
     * @Route("/{key1}/{key2}/delete", name="compositeKeys_delete")
     * @Method("post")
     */
    public function deleteAction($key1, $key2)
    {
        $form = $this->createDeleteForm($key1, $key2);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('AcmeCompositePrimaryKeysBundle:CompositeKeys')->find(array('key1' => $key1, 'key2' => $key2));

            if (!$entity) {
                $this->setErrorMessage('データが存在しません');
                return $this->redirect($this->generateUrl('compositeKeys'));
            }

            $em->remove($entity);
            $em->flush();
            $this->setNoticeMessage('データを削除しました');
        }

        return $this->redirect($this->generateUrl('compositeKeys'));
    }

    private function createDeleteForm($key1, $key2)
    {
        return $this->createFormBuilder(array('key1' => $key1, 'key2' => $key2))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    private function getMessage() {
        $request  = $this->getRequest();
        $message = null;
        if ($request->getSession()->has(CompositeKeysController::MESSAGE_KEY)) {
            $message = $request->getSession()->get(CompositeKeysController::MESSAGE_KEY);
            $request->getSession()->set(CompositeKeysController::MESSAGE_KEY, null);
        }
        return $message;
    }

    private function setNoticeMessage($message) {
        $this->setMessage('notice', $message);
    }
    private function setErrorMessage($message) {
        $this->setMessage('error', $message);
    }
    private function setMessage($type, $message) {
        $this->getRequest()->getSession()->set(CompositeKeysController::MESSAGE_KEY, array($type => $message));
    }
}
