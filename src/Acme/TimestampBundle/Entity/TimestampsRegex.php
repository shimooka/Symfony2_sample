<?php

namespace Acme\TimestampBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="timestamps_with_regex")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class TimestampsRegex
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
     *
     * type="datetime"なので、Regexアノテーションが使えない
     *
     *   Assert\Regex(pattern="#^([0-9]{4})/((0[13578]|1[02])/(0[1-9]|[12][0-9]|3[01])|(0[469]|11)/(0[1-9]|[12][0-9]|30)|02/(0[1-9]|[12][0-9]))$#", message="日付1が正しくありません")
    */
    protected $col1;
    public function getCol1() { return $this->col1; }
    public function setCol1($value) { $this->col1 = $value; }

    /**
     * @var string $col2 日付2
     *
     * @ORM\Column(name="col2", type="datetime", nullable=true)
     *
     * type="datetime"なので、Regexアノテーションが使えない
     *
     *     Assert\Regex(pattern="#^(19[0-9]{2}|2[0-9]{3})((0[13578]|1[02])(0[1-9]|[12][0-9]|3[01])|(0[469]|11)(0[1-9]|[12][0-9]|30)|02(0[1-9]|[12][0-9]))$#", message="日付2が正しくありません")
     */
    protected $col2;
    public function getCol2() { return $this->col2; }
    public function setCol2($value) { $this->col2 = $value; }

}