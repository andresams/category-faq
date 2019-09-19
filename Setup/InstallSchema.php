<?php
/**
 * Module Installer
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace Prestafy\Faq\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Prestafy\Faq\Model\ResourceModel\Category;
use Prestafy\Faq\Model\ResourceModel\Question;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        /**
         * Create Category Table
         */
        $fullTextIntex = ['name', 'description'];
        $categoryTableName = $setup->getTable(Category::TABLE_NAME);
        $questionTableName = $setup->getTable(Question::TABLE_NAME);

        $table = $setup->getConnection()->newTable(
            $categoryTableName
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'auto_increment' => true],
            'FAQ Category PK'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            256,
            ['nullable' => false],
            'Category name'
        )->addColumn(
            'description',
            Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Category name'
        )->addColumn(
            'sort_order',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => true],
            'Sort order position'
        )->addColumn(
            'status',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => true],
            'Category Display Status'
        )->addColumn(
            'created_at',
            Table::TYPE_DATETIME,
            null,
            ['default' => new \Zend_Db_Expr('CURRENT_TIMESTAMP')],
            'Date of creation of this category'
        )->addColumn(
            'updated_at',
            Table::TYPE_DATETIME,
            null,
            ['default' => new \Zend_Db_Expr('CURRENT_TIMESTAMP')],
            'Last update date of this category'
        )->setComment('FAQ Categories Table');

        $setup->getConnection()->createTable($table);
        $setup->getConnection()->addIndex(
            $categoryTableName,
            $setup->getIdxName(
                $categoryTableName,
                $fullTextIntex,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            $fullTextIntex,
            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
        );

        /**
         * Create Question Table
         */
        $table = $setup->getConnection()->newTable(
            $setup->getTable(Question::TABLE_NAME)
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'auto_increment' => true],
            'FAQ Question PK'
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            256,
            ['nullable' => false],
            'Question Title'
        )->addColumn(
            'answer',
            Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Answer for the question'
        )->addColumn(
            'status',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => true],
            'Question Display Status'
        )->addColumn(
            'sort_order',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => true],
            'Question Display Position'
        )->addColumn(
            'category_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => true],
            'Category associated with this question'
        )->addColumn(
            'created_at',
            Table::TYPE_DATETIME,
            null,
            ['default' => new \Zend_Db_Expr('CURRENT_TIMESTAMP')],
            'Date of creation of this category'
        )->addColumn(
            'updated_at',
            Table::TYPE_DATETIME,
            null,
            ['default' => new \Zend_Db_Expr('CURRENT_TIMESTAMP')],
            'Last update date of this category'
        )->addForeignKey(
            $setup->getFkName(
                $questionTableName,
                'category_id',
                $questionTableName,
                'id'
            ),
            'category_id',
            $setup->getTable($categoryTableName),
            'id',
            Table::ACTION_SET_NULL
        )->setComment('FAQ Questions Table');

        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}
