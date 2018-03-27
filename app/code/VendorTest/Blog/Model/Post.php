<?php

namespace VendorTest\Blog\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;

class Post extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'vendortest_blog_post';

    protected $_cacheTag = 'vendortest_blog_post';

    protected $_eventPrefix = 'vendortest_blog_post';

    protected function _construct()
    {
        $this->_init('VendorTest\Blog\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
