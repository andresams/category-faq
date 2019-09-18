<?php
/**
 * Category Model
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace Prestafy\Faq\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\DateTimeFactory;
use Prestafy\Faq\Model\ResourceModel\Category as CategoryResource;

class Category extends AbstractModel
{
    /**
     * @var DateTimeFactory
     */
    private $dateTimeFactory;

    public function __construct(
        Context $context,
        Registry $registry,
        DateTimeFactory $dateTimeFactory,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->dateTimeFactory = $dateTimeFactory;
    }

    public function _construct()
    {
        $this->_init(CategoryResource::class);
    }

    /**
     * Set updated_at before saving
     *
     * @return AbstractModel
     */
    public function beforeSave()
    {
        if ($this->getId()) {
            $this->setUpdatedAt($this->dateTimeFactory->create()->gmtDate());
        }

        return parent::beforeSave();
    }
}
