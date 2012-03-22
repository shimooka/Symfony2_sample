<?php

namespace Acme\FormTypeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * m_prefクラス
 *
 * @version $Id$
 * @ORM\Table(name="m_pref")
 * @ORM\Entity(repositoryClass="Acme\FormTypeBundle\Entity\MPrefRepository")
 * @ORM\HasLifecycleCallbacks
 */
class MPref
{
    /**
     * @var decimal $id ID
     *
     * @ORM\Column(name="id", type="decimal")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="m_pref_id_seq", allocationSize="1", initialValue="1")
     */
    private $id;

    /**
     * @var string $prefName 都道府県名
     *
     * @ORM\Column(name="pref_name", type="string", length=8, nullable=false)
     * @Assert\NotBlank(message="都道府県名は必須項目です")
     * @Assert\MaxLength(limit=8, message="都道府県名は{{ limit }}文字までです")
     */
    private $prefName;

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
     * Set prefName
     *
     * @param datetime $prefName
     */
    public function setPrefName($prefName)
    {
        $this->prefName = $prefName;
    }

    /**
     * Get prefName
     *
     * @return datetime 
     */
    public function getPrefName()
    {
        return $this->prefName;
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
