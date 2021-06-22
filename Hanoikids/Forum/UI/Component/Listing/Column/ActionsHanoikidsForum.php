<?php
namespace Hanoikids\Forum\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class ActionsHanoikidsForum extends Column {
	/** @var UrlInterface */
	protected $urlBuilder;

	/**
	 * @var string
	 */
	private $editUrl;
	private $deleteUrl;

	/**
	 * @param ContextInterface $context
	 * @param UiComponentFactory $uiComponentFactory
	 * @param UrlInterface $urlBuilder
	 * @param array $components
	 * @param array $data
	 * @param string $editUrl
	 */
	public function __construct(
		ContextInterface $context,
		UiComponentFactory $uiComponentFactory,
		UrlInterface $urlBuilder,
		array $components = [],
		array $data = []
	) {
		$this->urlBuilder = $urlBuilder;
		$this->editUrl = $data['vendorUrlPathEdit'];
		$this->deleteUrl = $data['vendorUrlPathDelete'];

		parent::__construct($context, $uiComponentFactory, $components, $data);
	}

	/**
	 * Prepare Data Source
	 *
	 * @param array $dataSource
	 * @return array
	 */
	public function prepareDataSource(array $dataSource) {
		if (isset($dataSource['data']['items'])) {
            // die('123');
			foreach ($dataSource['data']['items'] as &$item) {
				$name = $this->getData('name');
				if (isset($item['forum_id'])) {
					$item[$name]['edit'] = [
						'href' => $this->urlBuilder->getUrl($this->editUrl, ['id' => $item['forum_id']]),
						'label' => __('Edit'),
                        //set ID in the request list
					];
                    // die($this->editUrl);
					$item[$name]['delete'] = [
						'href' => $this->urlBuilder->getUrl($this->deleteUrl, ['id' => $item['forum_id']]),
						'label' => __('Delete'),
					];
				}
			}
		}
		return $dataSource;
	}
}