<?php
namespace Hanoikids\Forum\Model\ResourceModel\HanoikidsForum\Grid;


use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult
{
    public function __construct(
        EntityFactory $entityFactory, Logger $logger, FetchStrategy $fetchStrategy, EventManager $eventManager,
        $mainTable = 'quote',
        $resourceModel = 'Hanoikids\Forum\Model\ResourceModel\HanoikidsForum',
        $identifierName = null, $connectionName = null
    )
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel, $identifierName, $connectionName);
    }

    public function _initSelect()
    {
        parent::_initSelect();
        return $this->getSelect()->joinLeft(
            ['secondTable' => $this->getTable('customer_entity')], //2nd table name by which you want to join
            'main_table.customer_id= secondTable.entity_id', // common column which available in both table
            ['firstname','lastname']// '*' define that you want all column of 2nd table. if you want some particular column then you can define as ['column1','column2']
        );
    }
}