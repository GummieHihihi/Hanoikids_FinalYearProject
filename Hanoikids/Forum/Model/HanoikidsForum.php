<?php
namespace Hanoikids\Forum\Model;
/**
 * Class Vendor
 * @package Reward\Point\Model
 */
class HanoikidsForum extends \Magento\Framework\Model\AbstractModel {
	/**
	 * @param \Magento\Framework\Model\Context $context
	 * @param \Magento\Framework\Registry $registry
	 * @param ResourceModel\Vendor $resource
	 * @param ResourceModel\Vendor\Collection $resourceCollection
	 */
	public function __construct(
		\Magento\Framework\Model\Context $context,
		\Magento\Framework\Registry $registry,
		\Hanoikids\Forum\Model\ResourceModel\HanoikidsForum $resource, //resource cua cai model nay
		\Hanoikids\Forum\Model\ResourceModel\HanoikidsForum\Collection $resourceCollection //collection cua cai model nay
	) {
		parent::__construct(
			$context,
			$registry,
			$resource,
			$resourceCollection
		);
	}
}