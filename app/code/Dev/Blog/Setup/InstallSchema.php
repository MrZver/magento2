<?php
/**
 * Blog
 * 
 * @author Yurii Kliauz
 */
namespace Dev\Blog\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface {
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
		$setup->startSetup();
        $installer = $setup;

        /**
         * Create table 'dev_blog_category'
         */
        if (!$installer->tableExists('dev_blog_category'))
        {
            $tableCategory = $setup->getConnection()->newTable($setup->getTable('dev_blog_category'))
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary'  => true
                    ],
                    'Id'
                )->addColumn(
                    'title',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => true
                    ],
                    'Title'
                )->addColumn(
                    'description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => true
                    ],
                    'Description'
                )->setComment(
                    'Blog Category Table'
                );
            $setup->getConnection()->createTable($tableCategory);
        }

        /**
         * Create table 'dev_blog_post'
         */
        if (!$installer->tableExists('dev_blog_post'))
        {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('dev_blog_post')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Post ID'
                )->addColumn(
                    'category_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    255,
                    [
                        'nullable' => false,
                        'default' => '0'
                    ],
                    'Category Id'
                )
                ->addColumn(
                    'title',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Post title'
                )
                ->addColumn(
                    'description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Post description'
                )->setComment(
                    'Blog Post Table'
                );
            $installer->getConnection()->createTable($table);
        }
		$setup->endSetup();
	}
}