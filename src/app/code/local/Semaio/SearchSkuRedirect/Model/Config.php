<?php
/**
 * This file is part of the Semaio_SearchSkuRedirect module.
 *
 * See LICENSE.md bundled with this module for license details.
 *
 * @category  Semaio
 * @package   Semaio_SearchSkuRedirect
 * @author    semaio GmbH <hello@semaio.com>
 * @copyright 2016 semaio GmbH (http://www.semaio.com)
 */

/**
 * Class Semaio_SearchSkuRedirect_Model_Config
 */
class Semaio_SearchSkuRedirect_Model_Config
{
    const XML_PATH_SEARCHSKUREDIRECT_ENABLED = 'catalog/search/search_sku_redirect';
    const XML_PATH_SEARCHSKUREDIRECT_CHECK_PARENT_PRODUCT = 'catalog/search/search_sku_redirect_check_parent_product';

    /**
     * Retrieve the config setting if feature is enabled
     *
     * @param  Mage_Core_Model_Store|int|null $store Store
     * @return bool
     */
    public function isEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_SEARCHSKUREDIRECT_ENABLED, $store);
    }

    /**
     * Retrieve the config setting if check for parent product is enabled
     *
     * @param  Mage_Core_Model_Store|int|null $store Store
     * @return bool
     */
    public function isCheckParentProductEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_SEARCHSKUREDIRECT_CHECK_PARENT_PRODUCT, $store);
    }
}
