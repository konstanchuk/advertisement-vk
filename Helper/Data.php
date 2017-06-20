<?php

/**
 * Advertisement Vk Extension for Magento 2
 *
 * @author     Volodymyr Konstanchuk http://konstanchuk.com
 * @copyright  Copyright (c) 2017 The authors
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Konstanchuk\AdvertisementVk\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;


class Data extends AbstractHelper
{
    const XML_PATH_IS_ENABLED = 'sales/konstanchuk_advertisement_vk/active';
    const XML_PATH_POSITION_SCRIPT = 'sales/konstanchuk_advertisement_vk/position_script';
    const XML_PATH_DEFAULT_TARGET_CODE = 'sales/konstanchuk_advertisement_vk/default_target_code';

    public function isEnabled()
    {
        return (bool)$this->scopeConfig->getValue(
            static::XML_PATH_IS_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getPositionScript()
    {
        return $this->scopeConfig->getValue(
            static::XML_PATH_POSITION_SCRIPT,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getDefaultTargetCode()
    {
        return $this->scopeConfig->getValue(
            static::XML_PATH_DEFAULT_TARGET_CODE,
            ScopeInterface::SCOPE_STORE
        );
    }
}