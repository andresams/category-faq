<?php
/**
 * Install Sample Data
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace Prestafy\Faq\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Prestafy\Faq\Model\CategoryFactory;
use Prestafy\Faq\Model\QuestionFactory;

class InstallData implements InstallDataInterface
{
    /**
     * @var CategoryFactory
     */
    private $_categoryFactory;

    /**
     * @var QuestionFactory
     */
    private $_questionFactory;

    /**
     * Init
     *
     * @param CategoryFactory $categoryFactory
     * @param QuestionFactory $questionFactory
     */
    public function __construct(CategoryFactory $categoryFactory, QuestionFactory $questionFactory)
    {
        $this->_categoryFactory = $categoryFactory;
        $this->_questionFactory = $questionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * Add Default Category
         */
        $data = [
            'name'        => 'Default',
            'description' => 'When there is only 1 category',
            'position'    => 0,
            'status'      => 1,
            'category_id' => 1
        ];

        $category = $this->_categoryFactory->create();
        $category->addData($data)->save();

        /**
         * Add Sample Question
         */
        $data = [
            'title'  => 'What should I use this module for?',
            'answer' => 'Category FAQ module was designed as a simple solution to provide information for your customers',
            'status' => 1
        ];

        $question = $this->_questionFactory->create();
        $question->addData($data)->save();
    }
}
