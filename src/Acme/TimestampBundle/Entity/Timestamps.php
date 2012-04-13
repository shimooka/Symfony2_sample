<?php

namespace Acme\TimestampBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="timestamps")
 * @ORM\Entity()
 */
class Timestamps
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    public function getId() { return $this->id; }
    public function setId($value) { $this->id = $value; }

    /**
     * @var string $col1 日付1
     *
     * @ORM\Column(name="col1", type="datetime", nullable=false)
     * @Assert\NotBlank(message="日付1は必須項目です")
     */
    protected $col1;
    public function getCol1() { return $this->col1; }
    public function setCol1($value) { $this->col1 = $value; }

    /**
     * @var string $col2 日付2
     *
     * @ORM\Column(name="col2", type="datetime", nullable=true)
     */
    protected $col2;
    public function getCol2() { return $this->col2; }
    public function setCol2($value) { $this->col2 = $value; }

}