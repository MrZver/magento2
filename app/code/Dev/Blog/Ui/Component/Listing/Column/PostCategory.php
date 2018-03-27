<?php
/**
 * Blog
 * 
 * @author Yurii Kliauz
 */
namespace Dev\Blog\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;

class PostCategory extends \Magento\Ui\Component\Listing\Columns\Column
{
	protected $_objectManager;
	protected $storeManager;
	public function __construct(
		ContextInterface $context,
		UiComponentFactory $uiComponentFactory,
		StoreManagerInterface $storeManager,
		\Magento\Framework\ObjectManagerInterface $objectmanager,
		array $components = [],
		array $data = []
	) {
		$this->_objectManager = $objectmanager;
		$this->storeManager = $storeManager;
		parent::__construct($context, $uiComponentFactory, $components, $data);
	}
	public function prepareDataSource(array $dataSource) {
		if(isset($dataSource['data']['items'])) {
			foreach($dataSource['data']['items'] as & $item) {
				if($item && isset($item['category_id']) && $item['category_id'] > 0) {
					$category = $this->_objectManager->get('Dev\Blog\Model\Category')->load($item['category_id']);
					if($category->getId()){
						$title = $category->getData('title');
						$categoryId = $category->getData('category_id');
						if($categoryId != false && $categoryId > 0){
                            $category = $this->_objectManager->get('Dev\Blog\Model\Category')->load($categoryId);
                            if($category->getTitle()){
                                $title = $category->getTitle().' - '.$title;
                            }
						}
						$item['category_id'] = $title;
					}
					else{
						$item['category_id'] = NULL;
					}
				}
				else{
					$item['category_id'] = NULL;
				}
			}
		}
		return $dataSource;
	}
}