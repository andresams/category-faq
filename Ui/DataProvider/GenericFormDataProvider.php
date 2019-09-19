<?php
/**
 * DataProvider to be used with Ui Forms
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace Prestafy\Faq\Ui\DataProvider;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Ui\DataProvider\AbstractDataProvider;

class GenericFormDataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var string
     */
    protected $_fieldset;

    /**
     * Construct
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param AbstractCollection $collection
     * @param string $fieldset
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        AbstractCollection $collection,
        $fieldset,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection = $collection;
        $this->_fieldset = $fieldset;
    }

    /**
     * Get collection data for the fieldset General
     *
     * @return array
     */
    public function getData()
    {
        $result = [];

        foreach ($this->collection->getItems() as $item) {
            $result[$item->getId()][$this->_fieldset] =  $item->getData();

        }

        return $result;
    }
}
