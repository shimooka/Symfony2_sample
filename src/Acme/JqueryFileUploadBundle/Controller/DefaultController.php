<?php

namespace Acme\JqueryFileUploadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\JqueryFileUploadBundle\Entity\Item;
use Acme\JqueryFileUploadBundle\Form\UploadType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="jqueryFileUpload_index")
     * @Template()
     */
    public function indexAction()
    {
        $form = $this->createForm(new UploadType());
        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/upload", name="jqueryFileUpload_upload", defaults={"_format"="json"})
     * @Template()
     */
    public function uploadAction()
    {
        $form = new UploadType();
        $em = $this->get('doctrine')->getEntityManager();
        $parameters = $this->getRequest()->request->get($form->getName(), array());
        $entity = $em->getRepository('AcmeJqueryFileUploadBundle:Item')->find(isset($parameters['itemCode']) ? $parameters['itemCode'] : '');
        if ($entity === null) {
            $entity = new Item();
        }

        $form = $this->createForm($form, $entity);
        $form->bindRequest($this->getRequest());

        if (!$form->isValid()) {
die('入力内容が正しくありません');
        }

        try {
            $uploadedFile = $form['itemPicture']->getData();
            $entity->setItemPicture($uploadedFile->getClientOriginalName());
            $uploadedFile->move(
                __DIR__ . '/../Resources/uploads',
                $uploadedFile->getClientOriginalName()
            );

            $newFileInfo = new \SplFileInfo(__DIR__ . '/../Resources/uploads' . DIRECTORY_SEPARATOR . $uploadedFile->getClientOriginalName());

            $em = $this->get('doctrine')->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return array(
                'fileInfo' => $newFileInfo,
                'basename' => $newFileInfo->getBasename(".{$newFileInfo->getExtension()}"),
            );
        } catch (\Exception $e) {
die('$e->getMessage()');
        }
    }

    /**
     * @Route("/download/{filename}.{_format}",
     *        requirements={"_format" = "gif|png|jpg"},
     *        name="jqueryFileUpload_download")
     */
    public function downloadAction($filename, $_format)
    {
        $filename = basename($filename . ".{$_format}");

        $fileObject = new \SplFileObject(
            __DIR__ . '/../Resources/uploads' . DIRECTORY_SEPARATOR . $filename
        );
        if ($fileObject->isReadable() && $fileObject->isFile()) {
            $response = new Response();
            $mimeType = ($fileObject->getExtension() === 'jpg' ? 'jpeg' : $fileObject->getExtension());
            switch ($mimeType) {
            case 'jpeg':
            case 'png':
            case 'gif':
                $response->headers->set('Content-Type', "image/{$mimeType}");
                $response->setContent($fileObject->fpassthru());
            }
        }

        return $response;
    }
}
