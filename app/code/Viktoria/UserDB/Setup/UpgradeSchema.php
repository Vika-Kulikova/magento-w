<?php

namespace Viktoria\UserDB\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.3.2', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('new_contact'),
                'surname',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'after' => 'name',
                    'comment' => 'Surname'
                ]
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('new_contact'),
                'default_billing',
                [
                    'type' =>\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'length' => 255,
                    'after' => 'email',
                    'comment' => 'Default Billing Address'
                ]
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('new_contact'),
                'default_shipping',
                [
                    'type' =>\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'length' => 255,
                    'after' => 'email',
                    'comment' => 'Default Shipping Address'
                ]
            );
        }
        $setup->endSetup();
    }
}
