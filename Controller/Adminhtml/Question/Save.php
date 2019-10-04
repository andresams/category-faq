<?php
/**
 * Save Question Controller
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace Prestafy\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Prestafy\Faq\Model\QuestionFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class Save
 * @package Prestafy\Faq\Controller\Adminhtml\Question
 */
class Save extends Action implements HttpPostActionInterface
{
    private $collectionFactory;

    public function __construct(Action\Context $context, QuestionFactory $collectionFactory)
    {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue()['general'];

        if (!empty($data)) {
            try {
                $question = $this->collectionFactory->create();

                if (!empty($data['id'])) {
                    $question->load($data['id']);
                }

                $data = array_filter($data, function ($value) {
                    return $value !== '';
                });

                $question->setData($data);
                $question->save();
                $this->messageManager->addSuccessMessage(__('Successfully saved the question.'));
                $this->_objectManager->get(Session::class)->setFormData(false);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->_objectManager->get(Session::class)->setFormData($data);

                if (!empty($data['id'])) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $data['id']]);
                }

                return $resultRedirect->setPath('*/*/add');
            }
        }

        return $resultRedirect->setPath('faq/question/index');
    }
}
