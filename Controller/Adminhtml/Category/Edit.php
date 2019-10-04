<?php
/**
 * Category Index Controller
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace Prestafy\Faq\Controller\Adminhtml\Category;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Class Edit
 * @package Prestafy\Faq\Controller\Adminhtml\Category
 */
class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        return $result;
    }
}
