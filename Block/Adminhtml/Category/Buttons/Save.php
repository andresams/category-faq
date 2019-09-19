<?php
/**
 * Save Category Button
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace Prestafy\Faq\Block\Adminhtml\Category\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save implements ButtonProviderInterface
{
    /**
     * Get Save Button data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Category'),
            'class' => 'primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }

    /**
     * Get form save url
     *
     * @return mixed
     */
    public function getSaveUrl()
    {
        $params = [];

        if (!empty($this->getRequest()->getParam('id'))) {
            $params = ['id' => $this->getRequest()->getParam('id')];
        }

        return $this->getUrl('*/*/save', $params);
    }
}
