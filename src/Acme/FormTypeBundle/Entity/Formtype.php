<?php

namespace Acme\FormTypeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * formtypeクラス
 *
 * @version $Id$
 * @ORM\Table(name="formtype")
 * @ORM\Entity(repositoryClass="Acme\FormTypeBundle\Entity\FormtypeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Formtype
{
    /**
     * @var decimal $id ID
     *
     * @ORM\Column(name="id", type="decimal")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="formtype_id_seq", allocationSize="1", initialValue="1")
     */
    private $id;

    /**
     * @var string $title 氏名
     *
     * @ORM\Column(name="title", type="string", length=10, nullable=false)
     * @Assert\NotBlank(message="氏名は必須項目です")
     * @Assert\MaxLength(limit=10, message="氏名は{{ limit }}文字までです")
     */
    private $title;

    /**
     * @var string $prefecture 都道府県コード1
     *
     * @ORM\Column(name="prefecture", type="string", length=2, nullable=false)
     * @Assert\NotBlank(message="都道府県コード1は必須項目です")
     * @Assert\MaxLength(limit=2, message="都道府県コード1は{{ limit }}文字までです")
     * @Assert\Regex(pattern="#^[0-9]{1,2}$#", message="都道府県コード1の書式が正しくありません")
     */
    private $prefecture;

    /**
     * @var string $gender 性別
     *
     * @ORM\Column(name="gender", type="string", length=1, nullable=false)
     * @Assert\NotBlank(message="性別は必須項目です")
     * @Assert\MaxLength(limit=1, message="性別は{{ limit }}文字までです")
     */
    private $gender;

    /**
     * @var string $registerDate1 登録日1
     *
     * @ORM\Column(name="register_date1", type="datetime", nullable=false)
     * @Assert\NotBlank(message="登録日1は必須項目です")
     */
    private $registerDate1;

    /**
     * @var string $registerDate2 登録日2
     *
     * @ORM\Column(name="register_date2", type="string", length=10, nullable=true)
     * @Assert\MaxLength(limit=10, message="登録日2は{{ limit }}文字までです")
     */
    private $registerDate2;

    /**
     * @var datetime $insertDate 登録日時
     *
     * @ORM\Column(name="insert_date", type="datetime")
     */
    private $insertDate;

    /**
     * @var datetime $updateDate 最終更新日時
     *
     * @ORM\Column(name="update_date", type="datetime")
     */
    private $updateDate;

    /**
     * @var string $deleteFlag 削除フラグ
     *
     * @ORM\Column(name="delete_flag", type="string")
     * @Assert\Choice(choices={"0", "1"}, message="削除フラグには0もしくは1を指定してください")
     */
    private $deleteFlag = '0';

    /**
     * Set title
     *
     * @param datetime $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return datetime
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set prefecture
     *
     * @param datetime $prefecture
     */
    public function setPrefecture($prefecture)
    {
        $this->prefecture = $prefecture;
    }

    /**
     * Get prefecture
     *
     * @return datetime
     */
    public function getPrefecture()
    {
        return $this->prefecture;
    }

    /**
     * Set gender
     *
     * @param datetime $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return datetime
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set registerDate1
     *
     * @param datetime $registerDate1
     */
    public function setRegisterDate1($registerDate1)
    {
        $this->registerDate1 = $registerDate1;
    }

    /**
     * Get registerDate1
     *
     * @return datetime
     */
    public function getRegisterDate1()
    {
        return $this->registerDate1;
    }

    /**
     * Set registerDate2
     *
     * @param datetime $registerDate2
     */
    public function setRegisterDate2($registerDate2)
    {
        $this->registerDate2 = $registerDate2;
    }

    /**
     * Get registerDate2
     *
     * @return datetime
     */
    public function getRegisterDate2()
    {
        return $this->registerDate2;
    }

    /**
     * Set insertDate
     *
     * @param datetime $insertDate
     */
    public function setInsertDate($insertDate)
    {
        $this->insertDate = $insertDate;
    }

    /**
     * Get insertDate
     *
     * @return datetime
     */
    public function getInsertDate()
    {
        return $this->insertDate;
    }

    /**
     * Set updateDate
     *
     * @param datetime $updateDate
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;
    }

    /**
     * Get updateDate
     *
     * @return datetime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set deleteFlag
     *
     * @param string $deleteFlag
     */
    public function setDeleteFlag($deleteFlag)
    {
        $this->deleteFlag = $deleteFlag;
    }

    /**
     * Get deleteFlag
     *
     * @return string
     */
    public function getDeleteFlag()
    {
        return $this->deleteFlag;
    }

    /**
     * Get id
     *
     * @return decimal
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setInsertDate(new \DateTime());
        $this->setUpdateDate(new \DateTime());
        if (is_null($this->getDeleteFlag())) {
            $this->setDeleteFlag('0');
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setUpdateDate(new \DateTime());
    }

}
