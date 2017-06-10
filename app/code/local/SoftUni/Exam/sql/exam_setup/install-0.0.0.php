<?php

$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('exam_contest'))
    ->addColumn('contest_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
    ), 'Contest ID')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ), 'Contest Title')
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
    ), 'Contest Description')
    ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_BOOLEAN, 0, array(
        'nullable' => false,
        'default' => 0,
    ), 'Contest Status')
    ->addColumn('start_date', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    ), 'Start Date')
    ->addColumn('end_date', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    ), 'End Date')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Updated At');

$installer->getConnection()->createTable($table);

$installer->endSetup();
