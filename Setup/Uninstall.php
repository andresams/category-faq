<?php
/**
 * Module Uninstaller
 *
 * @category   Prestafy
 * @package    Prestafy_Faq
 * @author     Andresa Martins <contact@andresa.dev>
 * @copyright  Copyright (c) 2019 Prestafy eCommerce Solutions (https://www.prestafy.com.br)
 * @license    http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace Prestafy\Faq\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;
use Prestafy\Faq\Model\ResourceModel\Category;
use Prestafy\Faq\Model\ResourceModel\Question;

class Uninstall implements UninstallInterface
{
    public function uninstall(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        /** @var AdapterInterface $connection */
        $connection = $installer->getConnection();
        $connection->dropTable(Category::TABLE_NAME);
        $connection->dropTable(Question::TABLE_NAME);

        $installer->endSetup();
    }
}