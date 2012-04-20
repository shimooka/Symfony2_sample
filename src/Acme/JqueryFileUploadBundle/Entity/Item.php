<?php

namespace Acme\JqueryFileUploadBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Acme\JqueryFileUploadBundle\Entity\Base\ItemBase;
use Acme\JqueryFileUploadBundle\Component\Validator\Constraints as AcmeAssert;

/**
 * @ORM\Table(name="m_item")
 * @ORM\Entity(repositoryClass="Acme\JqueryFileUploadBundle\Entity\ItemRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Item extends ItemBase
{
}
