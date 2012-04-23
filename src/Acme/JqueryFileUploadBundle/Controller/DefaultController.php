<?php

namespace Acme\JqueryFileUploadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\JqueryFileUploadBundle\Entity\Item;
use Acme\JqueryFileUploadBundle\Form\UploadType;

class DefaultController extends Controller
{
    /**
     * @Route("/{itemCode}", name="jqueryFileUpload_index")
     * @Template()
     */
    public function indexAction($itemCode)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $entity = $em->getRepository('AcmeJqueryFileUploadBundle:Item')->find($itemCode);
        $basename = null;
        $extension = null;
        if ($entity === null) {
            $entity = new Item();
            $entity->setItemCode($itemCode);
        }

        $form = $this->createForm(new UploadType(), $entity);
        return array(
            'form' => $form->createView(),
            'entity' => $entity,
        );
    }

    /**
     * @Route("/{itemCode}/upload", name="jqueryFileUpload_upload", defaults={"_format"="json"})
     * @Template()
     * @Method("post")
     */
    public function uploadAction($itemCode)
    {
        $form = new UploadType();
        $em = $this->get('doctrine')->getEntityManager();
        $entity = $em->getRepository('AcmeJqueryFileUploadBundle:Item')->find($itemCode);
        if ($entity === null) {
            $entity = new Item();
            $entity->setItemCode($itemCode);
        }

        $form = $this->createForm($form, clone $entity);
        $form->bindRequest($this->getRequest());

        if (!$form->isValid()) {
die('入力内容が正しくありません');
        }

        $target_name = null;
        foreach ($form->getIterator() as $name => $formObj) {
            if (preg_match('/^itemPicture(0[1-9]|10)$/', $name, $matches) && $formObj->getData() !== null) {
                $target_name = $name;
                break;
            }
        }
        if ($target_name === null) {
die('入力内容が正しくありません');
        }
        $target_index = $matches[1];

        try {
            $uploadPath = __DIR__ . '/../Resources/uploads' . DIRECTORY_SEPARATOR . substr($itemCode, 0, 2);
            $uploadedFile = $form[$target_name]->getData();

            $clientOriginalFile = new \SplFileInfo($uploadedFile->getClientOriginalName());
            $newFileName = sprintf('%s_%s.%s', $itemCode, $target_index, strtolower($clientOriginalFile->getExtension()));
            $uploadedFile->move($uploadPath, $newFileName);
            $newFileInfo = new \SplFileInfo($uploadPath . DIRECTORY_SEPARATOR . $newFileName);

            $em = $this->get('doctrine')->getEntityManager();
            $methodName = 'set' . ucfirst($target_name);
            $entity->$methodName($newFileName);
            $em->persist($entity);
            $em->flush();

            return array(
                'fileInfo' => $newFileInfo,
                'basename' => $newFileInfo->getBasename('.' . $newFileInfo->getExtension()),
            );
        } catch (\Exception $e) {
die($e->getMessage());
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
        $full_filename = __DIR__ . '/../Resources/uploads' . DIRECTORY_SEPARATOR . substr($filename, 0, 2) . DIRECTORY_SEPARATOR . $filename;

        $fileInfo = new \SplFileInfo($full_filename);
        if ($fileInfo->isReadable() && $fileInfo->isFile()) {
            $response = new Response();
            $mimeType = ($fileInfo->getExtension() === 'jpg' ? 'jpeg' : $fileInfo->getExtension());
            switch ($mimeType) {
            case 'jpeg':
            case 'png':
            case 'gif':
                $response->headers->set('Content-Type', "image/{$mimeType}");
                $contents = file_get_contents($full_filename);
                $response->setContent($contents);
                $response->headers->set('Content-Length', strlen($contents));
                $response->setETag(md5($response->getContent()));
                $response->setLastModified(new \DateTime('@' . $fileInfo->getMTime()));
                $response->isNotModified($this->getRequest());
            }
        }

        return $response;
    }
}
