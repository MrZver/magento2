<?php
/**
 * Blog
 * 
 * @author Yurii Kliauz
 */
namespace Dev\Blog\Controller\Adminhtml\Posts;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

class Add extends Action {
	public function execute(){
		$this->_forward('edit');
	}
}