<?php
/**
 * A View Model that displays a list of questions
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */
namespace Prestafy\Faq\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Prestafy\Faq\Model\ResourceModel\Question\CollectionFactory;

/**
 * Class Questions
 * @package Prestafy\Faq\ViewModel
 */
class Questions implements ArgumentInterface
{
    /*
    * This label won't be displayed in the frontend block
    */
    const MAIN_LABEL = 'Default';

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Questions constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get All Questions
     *
     * @return \Magento\Framework\DataObject[]
     */
    public function getItems()
    {
        $questionCollection = $this->collectionFactory->create();
        $questionCollection->addFieldToFilter('main_table.status', 1);
        $questionCollection->setOrder('categoryName', 'DESC');

        return $questionCollection->getItems();
    }
}