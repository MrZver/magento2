<?php
/**
 * Blog
 * 
 * @author Yurii Kliauz
 */
namespace Dev\Blog\Model;

use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel {
	public function __construct(
		\Magento\Framework\Model\Context $context,
		\Magento\Framework\Registry $registry
		){
		parent::__construct($context, $registry);
	}
	protected function _construct() {
		$this->_init('Dev\Blog\Model\ResourceModel\Post');
	}
}