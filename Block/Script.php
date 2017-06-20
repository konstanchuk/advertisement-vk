<?php

/**
 * Advertisement Vk Extension for Magento 2
 *
 * @author     Volodymyr Konstanchuk http://konstanchuk.com
 * @copyright  Copyright (c) 2017 The authors
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Konstanchuk\AdvertisementVk\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Konstanchuk\AdvertisementVk\Helper\Data as Helper;


class Script extends Template
{
    /** @var Helper  */
    protected $_helper;

    /** @var Registry  */
    protected $_registry;

    protected $_targetCode = null;

    public function __construct(Template\Context $context, Helper $helper, Registry $registry, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_helper = $helper;
        $this->_registry = $registry;
    }

    public function getTargetCode()
    {
        if (is_null($this->_targetCode)) {
            $routerName = $this->getRequest()->getFullActionName();
            $targetCode = '';
            if ($routerName == 'catalog_category_view') {
                $category = $this->_registry->registry('current_category');
                if ($category && $category->getId()) {
                    $targetCode = trim($category->getData('vk_target_ads_code'));
                }
            } else if ($routerName == 'catalog_product_view') {
                $product = $this->_registry->registry('current_product');
                if ($product && $product->getId()) {
                    $targetCode = trim($product->getData('vk_target_ads_code'));
                }
            }
            if (empty($targetCode)) {
                $targetCode = trim($this->_helper->getDefaultTargetCode());
            }
            $this->_targetCode = $targetCode;
        }
        return $this->_targetCode;
    }

    public function toHtml()
    {
        if ($this->_helper->isEnabled() && $this->getTargetCode()) {
            return parent::toHtml();
        }
    }
}