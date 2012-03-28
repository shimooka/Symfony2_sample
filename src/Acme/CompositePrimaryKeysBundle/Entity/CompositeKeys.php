<?php

namespace Acme\CompositePrimaryKeysBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * composite_keysクラス
 *
 * @version $Id$
 * @ORM\Table(name="composite_keys")
 * @ORM\Entity(repositoryClass="Acme\CompositePrimaryKeysBundle\Entity\CompositeKeysRepository")
 * @ORM\HasLifecycleCallbacks
 */
class CompositeKeys
{
    /**
     * @var string $key1 複合キー1
     *
     * @ORM\Id
     * @ORM\Column(name="key1", type="string", length=2, nullable=false)
     * @Assert\NotBlank(message="複合キー1は必須項目です")
     * @Assert\MaxLength(limit=2, message="複合キー1は{{ limit }}文字までです")
     * @Assert\Regex(pattern="#^[0-9]{2}$#", message="複合キー1の書式が正しくありません")
     */
    private $key1;

    /**
     * @var string $key2 複合キー2
     *
     * @ORM\Id
     * @ORM\Column(name="key2", type="string", length=2, nullable=false)
     * @Assert\NotBlank(message="複合キー2は必須項目です")
     * @Assert\MaxLength(limit=2, message="複合キー2は{{ limit }}文字までです")
     * @Assert\Regex(pattern="#^[0-9]{2}$#", message="複合キー2の書式が正しくありません")
     */
    private $key2;

    /**
     * @var string $name 名称
     *
     * @ORM\Column(name="name", type="string", length=10, nullable=false)
     * @Assert\NotBlank(message="名称は必須項目です")
     * @Assert\MaxLength(limit=10, message="名称は{{ limit }}文字までです")
     */
    private $name;

    /**
     * Set key1
     *
     * @param datetime $key1
     */
    public function setKey1($key1)
    {
        $this->key1 = $key1;
    }

    /**
     * Get key1
     *
     * @return datetime
     */
    public function getKey1()
    {
        return $this->key1;
    }

    /**
     * Set key2
     *
     * @param datetime $key2
     */
    public function setKey2($key2)
    {
        $this->key2 = $key2;
    }

    /**
     * Get key2
     *
     * @return datetime
     */
    public function getKey2()
    {
        return $this->key2;
    }

    /**
     * Set name
     *
     * @param datetime $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return datetime
     */
    public function getName()
    {
        return $this->name;
    }

}
