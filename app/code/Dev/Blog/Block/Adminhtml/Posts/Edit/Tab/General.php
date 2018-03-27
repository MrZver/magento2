<?php
/**
 * Blog
 * 
 * @author Yurii Kliauz
 */
namespace Dev\Blog\Block\Adminhtml\Posts\Edit\Tab;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
 
class General extends Generic implements TabInterface {
	protected $_wysiwygConfig;
	protected $_objectManager;
	public function __construct(
		Context $context,
		Registry $registry,
		FormFactory $formFactory,
		Config $wysiwygConfig,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		array $data = []
	) {
		$this->_objectManager = $objectManager;
		$this->_wysiwygConfig = $wysiwygConfig;
		parent::__construct($context, $registry, $formFactory, $data);
	}
	protected function _prepareForm(){
		$model = $this->_coreRegistry->registry('post');
		$form = $this->_formFactory->create();
 
		$fieldset = $form->addFieldset(
			'base_fieldset',
			['legend' => __('General')]
		);
 
		if ($model->getId()) {
			$fieldset->addField(
				'id',
				'hidden',
				['name' => 'id']
			);
		}
		$fieldset->addField(
			'title',
			'text',
			[
				'name' => 'title',
				'label'	=> __('Title'),
				'required' => true
			]
		);
		$fieldset->addField(
			'description',
			'editor',
			[
				'name' => 'description',
				'label' => __('Description'),
				'required' => true,
				'style' => 'height: 15em; width: 100%;',
				'config' => $this->_wysiwygConfig->getConfig()
			]
		);

        $categoriesTree = [
            ['value'=>"0",'label'=>__('None')]
        ];
        $categories = $this->_objectManager->get('\Dev\Blog\Model\Category')->getCollection();
        if($categories->count()>0){
            foreach ($categories as $group) {
                $title = $group->getTitle();
                $groupItem = [
                    'value' => $group->getId(),
                    'label' => $title
                ];
                $categoriesTree[] = $groupItem;
            }
        }
        $fieldset->addField(
            'category_id',
            'select',
            [
                'name' => 'category_id',
                'label'	=> __('Category'),
                'required' => true,
                'values' => $categoriesTree
            ]
        );

		$data = $model->getData();
		$form->setValues($data);
		$this->setForm($form);
 
		return parent::_prepareForm();
	}
	public function getTabLabel(){
		return __('Post');
	}
	public function getTabTitle(){
		return __('Post');
	}
	public function canShowTab(){
		return true;
	}
	public function isHidden(){
		return false;
	}
}