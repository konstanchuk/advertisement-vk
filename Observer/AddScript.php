<?php

/**
 * Advertisement Vk Extension for Magento 2
 *
 * @author     Volodymyr Konstanchuk http://konstanchuk.com
 * @copyright  Copyright (c) 2017 The authors
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Konstanchuk\AdvertisementVk\Observer;

use Konstanchuk\AdvertisementVk\Model\System\Config\PositionScript;
use Magento\Framework\Event\ObserverInterface;
use Konstanchuk\AdvertisementVk\Helper\Data as Helper;
use Magento\Framework\View\Layout;


class AddScript implements ObserverInterface
{
    /** @var Helper */
    protected $_helper;

    public function __construct(Helper $helper)
    {
        $this->_helper = $helper;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->_helper->isEnabled()) {
            return;
        }
        /** @var Layout $layout */
        $layout = $observer->getLayout();
        if ($this->_helper->getPositionScript() == PositionScript::BODY) {
            $layout->getUpdate()->addHandle('advertisementvk_body');
        } else {
            $layout->getUpdate()->addHandle('advertisementvk_head');
        }
    }
}