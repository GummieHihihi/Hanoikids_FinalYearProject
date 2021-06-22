<?php
namespace Hanoikids\Forum\Setup;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Magestore\Multivendor\Setup
 */
class InstallSchema implements InstallSchemaInterface {
	/**
	 * @param SchemaSetupInterface $setup
	 * @param ModuleContextInterface $context
	 * @throws \Zend_Db_Exception
	 */
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {

		$installer = $setup;
		$installer->startSetup();
		/*
			         * Drop tables if exists
		*/

		//install table client point in customer grid
		$installer->getConnection()->dropTable($installer->getTable('hanoikids_forum'));
		$installer->getConnection()->dropTable($installer->getTable('forum_comment'));
		$installer->getConnection()->dropTable($installer->getTable('forum_likes'));
		$installer->getConnection()->dropTable($installer->getTable('forum_dislikes'));

		$table = $installer->getConnection()->newTable(
			$installer->getTable('hanoikids_forum')
		)->addColumn(
			'forum_id', Table::TYPE_INTEGER, null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'ID'
		)->addColumn(
			'customer_id', Table::TYPE_INTEGER, null,
			['nullable' => false, 'unsigned' => true],
			'customer ID'
		)->addColumn(
			'status', Table::TYPE_INTEGER, null,
			['nullable' => false, 'unsigned' => true, 'default' => 0],
			'status of this thread, 1 is enable 2 is disable'
		)->addColumn(
			'content', Table::TYPE_TEXT, null,
			['nullable' => false, 'unsigned' => true, 'default' => 0],
			'client point of the customer'
		)->addColumn(
			'attachments', Table::TYPE_TEXT, null,
			['nullable' => true, 'unsigned' => true, 'default' => 0],
			'client point of the customer'
		)->addColumn(
			'header', Table::TYPE_TEXT, null,
			['nullable' => true, 'unsigned' => true, 'default' => 0],
			'header of the forum'
		);
		$installer->getConnection()->createTable($table);
		$installer->endSetup();

		$table = $installer->getConnection()->newTable(
			$installer->getTable('forum_comment')
		)->addColumn(
			'comment_id', Table::TYPE_INTEGER, null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'ID of the comment'
		)->addColumn(
			'customer_id', Table::TYPE_INTEGER, null,
			['nullable' => false, 'unsigned' => true],
			'customer ID'
		)->addColumn(
			'forum_id', Table::TYPE_INTEGER, null,
			['nullable' => false, 'unsigned' => true],
			'id of the forum this comment belong to'
		)->addColumn(
			'content', Table::TYPE_TEXT, null,
			['nullable' => false, 'unsigned' => true, 'default' => 0],
			'client point of the customer'
		);
		$installer->getConnection()->createTable($table);
		$installer->endSetup();

		//table like of forum
		$table = $installer->getConnection()->newTable(
			$installer->getTable('forum_likes')
		)->addColumn(
			'ID', Table::TYPE_INTEGER, null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'ID of the likes : customer_idforum'
		)->addColumn(
			'customer_id', Table::TYPE_INTEGER, null,
			['nullable' => false, 'unsigned' => true],
			'customer ID'
		)->addColumn(
			'status', Table::TYPE_INTEGER, null,
			['nullable' => false, 'unsigned' => true, 'default' => 0],
			'status of this thread'
		)->addColumn(
			'forum_id', Table::TYPE_TEXT, null,
			['nullable' => false, 'unsigned' => true, 'default' => 0],
			'forum ID that this like belong to'
		);

		$installer->getConnection()->createTable($table);
		$installer->endSetup();
		//if not working, remove this module in setup_module in daatabase

	}
}