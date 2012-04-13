<?php

namespace Acme\TimestampBundle\Entity;

use Acme\TimestampBundle\Component\Validator\Constraints as AcmeAssert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="timestamps_with_constraint")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class TimestampsConstraint
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

    /**
     * バリデーションに使用する仮想的なカラム(日付1)
     *
     * @var string $col1Temporary 日付1
     *
     * @Assert\NotBlank(message="日付1は必須項目です")
     * @AcmeAssert\DateFormat(pattern="Y/m/d", title="日付1", message="{{ title }}はYYYY/MM/DD形式で入力してください", invalid="{{ title }}は有効な日付ではありません")
     */
    protected $col1Temporary;
    public function getCol1Temporary() { return $this->col1Temporary; }
    public function setCol1Temporary($value) { $this->col1Temporary = $value; }

    /**
     * バリデーションに使用する仮想的なカラム(日付2)
     *
     * @var string $col2Temporary 日付2
     *
     * @AcmeAssert\DateFormat(pattern="Ymd", title="日付2", message="{{ title }}はYYYYMMDD形式出入力してください", invalid="{{ title }}は有効な日付ではありません")
     */
    protected $col2Temporary;
    public function getCol2Temporary() { return $this->col2Temporary; }
    public function setCol2Temporary($value) { $this->col2Temporary = $value; }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        /**
         * 保存する前にカラムに値を設定する
         */
        $this->col1 = new \DateTime($this->getCol1Temporary());
        if ($this->getCol2Temporary() !== null || $this->getCol2Temporary() !== '') {
            $this->col2 = new \DateTime($this->getCol2Temporary());
        }
    }

}