<?php
/**
 * Blog
 * 
 * @author Yurii Kliauz
 */
namespace Dev\Blog\Model;

use Magento\Framework\Model\AbstractModel;

class Category extends AbstractModel {
	protected $urlInterface;
	public function __construct(
		\Magento\Framework\Model\Context $context,
		\Magento\Framework\UrlInterface $urlInterface,
		\Magento\Framework\Registry $registry
		){
		$this->urlInterface = $urlInterface;
		parent::__construct($context, $registry);
	}
	protected function _construct() {
		$this->_init('Dev\Blog\Model\ResourceModel\Category');
	}
	public function getUrl() {
		return $this->urlInterface->getUrl(
				'blog/category/view',
				[
					'id' => $this->getData('id')
				]
			);
	}
}