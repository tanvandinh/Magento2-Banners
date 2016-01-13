<?php

namespace TanDinh\Banner\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;

        $installer->startSetup();

        /**
         *Create banner table
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('tandinh_banner'))
            ->addColumn(
                'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Id'
            )
            ->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null],
                'Title'
            )->addColumn(
                'show_title',
                \Magento\Framework\DB\Ddl\Table::TYPE_BLOB,null,
                ['default' => null , 'nullable' => false],
                'Show Title'
            )->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_BLOB,
                null,
                ['default' => null],
                'Status'
            )->addColumn(
                'slider_code',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null],
                'Embed Code'
            );

        $installer->getConnection()->createTable($table);

        /**
         *Create banner items table
         */

        $table = $installer->getConnection()
            ->newTable($installer->getTable('tandinh_banner_items'))
            ->addColumn(
                'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Id'
            )
            ->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null],
                'Title'
            )->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_BLOB,
                null,
                ['default' => null],
                'Status'
            )
            ->addColumn(
                'banner',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['default' => null],
                'Banner'
            )->addColumn(
                'alt',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null],
                'Alt'
            )->addColumn(
                'url',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null],
                'Url'
            )->addColumn(
                'image',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null],
                'Image'
            )->addColumn(
                'start_date',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null],
                'Start Date'
            )->addColumn(
                'end_date',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null],
                'End Date'
            )->addColumn(
                'target',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['default' => null],
                'Target'
            );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
