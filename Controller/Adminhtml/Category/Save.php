<?php
/**
 * Save Category
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace Prestafy\Faq\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Prestafy\Faq\Model\CategoryFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class Save
 * @package Prestafy\Faq\Controller\Adminhtml\Category
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var CategoryFactory
     */
    private $categoryFactory;

    /**
     * Save constructor.
     *
     * @param Action\Context $context
     * @param CategoryFactory $categoryFactory
     */
    public function __construct(Action\Context $context, CategoryFactory $categoryFactory)
    {
        parent::__construct($context);
        $this->categoryFactory = $categoryFactory;
    }

    /**
     * Save POST data from ADD and EDIT controllers
     *
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        /**
         * TODO: Replace Model with Service Contract Persistence Operations
         */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue()['general'];

        if (!empty($data)) {
            try {
                $category = $this->categoryFactory->create();

                if (!empty($data['id'])) {
                    $category->load($data['id']);
                }

                $data = array_filter($data, function ($value) {
                    return $value !== '';
                });

                $category->setData($data);
                $category->save();
                $this->messageManager->addSuccessMessage(__('Successfully saved the item.'));
                $this->_objectManager->get(Session::class)->setFormData(false);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->_objectManager->get(Session::class)->setFormData($data);

                if (!empty($data['id'])) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $category->getId()]);
                }

                return $resultRedirect->setPath('*/*/add');
            }
        }
        return $resultRedirect->setPath('faq/category/index');
    }
}
