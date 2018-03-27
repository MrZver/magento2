<?php
/**
 * Blog
 * 
 * @author Yurii Kliauz
 */
namespace Dev\Blog\Block\Adminhtml\Posts\Edit;
 
use Magento\Backend\Block\Widget\Tabs as WidgetTabs;
 
class Tabs extends WidgetTabs{
	protected function _construct(){
		parent::_construct();
		$this->setId('post_edit_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Post'));
	}
	protected function _beforeToHtml(){
		$this->addTab(
			'general_data',
			[
				'label' => __('General'),
				'title' => __('General'),
				'content' => $this->getLayout()->createBlock(
					'Dev\Blog\Block\Adminhtml\Posts\Edit\Tab\General'
				)->toHtml(),
				'active' => true
			]
		);
		return parent::_beforeToHtml();
	}
}