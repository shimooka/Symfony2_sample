<?php

namespace Acme\JqueryFileUploadBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * m_itemクラス
 *
 * @author  SHIMOOKA Hideyuki <shimooka@cellant.jp>
 * @version $Id: ItemBase.php 106 2012-04-16 09:34:58Z shimooka@cellant.jp $
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
class ItemBase
{
    /**
     * @var string $itemCode 商品番号
     *
     * @ORM\Id
     * @ORM\Column(name="item_code", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="商品番号は必須項目です")
     * @Assert\MaxLength(limit=20, message="商品番号は{{ limit }}文字以内で入力してください")
     * @Assert\Regex(pattern="#^[0-9a-zA-Z][-_0-9a-zA-Z]{0,}$#", message="商品番号は半角英数記号(-_)で入力してください")
     */
    protected $itemCode;

    /**
     * @var string $itemPicture 商品画像
     *
     * @ORM\Column(name="item_picture", type="string", length=128, nullable=true)
     * @Assert\MaxLength(limit=128, message="商品画像は{{ limit }}文字以内で入力してください")
     */
    protected $itemPicture;

    /**
     * Set itemCode
     *
     * @param string $itemCode
     */
    public function setItemCode($itemCode)
    {
        $this->itemCode = $itemCode;
    }

    /**
     * Get itemCode
     *
     * @return itemCode
     */
    public function getItemCode()
    {
        return $this->itemCode;
    }

    /**
     * Set itemPicture
     *
     * @param string $itemPicture
     */
    public function setItemPicture($itemPicture)
    {
        $this->itemPicture = $itemPicture;
    }

    /**
     * Get itemPicture
     *
     * @return itemPicture
     */
    public function getItemPicture()
    {
        return $this->itemPicture;
    }

}
