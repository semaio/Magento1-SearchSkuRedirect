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
 * Class Semaio_SearchSkuRedirect_Model_Factory
 */
class Semaio_SearchSkuRedirect_Model_Factory
{
    /**
     * Retrieve the current store
     *
     * @return Mage_Core_Model_Store
     */
    public function getCurrentStore()
    {
        return Mage::app()->getStore();
    }

    /**
     * Retrieve the catalogsearch helper
     *
     * @return Mage_CatalogSearch_Helper_Data
     */
    public function getCatalogSearchHelper()
    {
        return Mage::helper('catalogsearch');
    }

    /**
     * Retrieve the config model
     *
     * @return Semaio_SearchSkuRedirect_Model_Config
     */
    public function getConfig()
    {
        return Mage::getModel('semaio_searchskuredirect/config');
    }

    /**
     * Retrieve the service for finding an enabled product by sku
     *
     * @return Semaio_SearchSkuRedirect_Model_Service_FindProductBySku
     */
    public function getServiceFindProductBySku()
    {
        /** @var Semaio_SearchSkuRedirect_Model_Service_FindProductBySku $service */
        $service = Mage::getModel('semaio_searchskuredirect/service_findProductBySku');
        $service->setStoreId($this->getCurrentStore()->getId());

        return $service;
    }

    /**
     * Retrieve the service for finding the first active parent product for
     * the given product id
     *
     * @return Semaio_SearchSkuRedirect_Model_Service_FindParentProductId
     */
    public function getServiceFindParentProductId()
    {
        /** @var Semaio_SearchSkuRedirect_Model_Service_FindParentProductId $service */
        $service = Mage::getModel('semaio_searchskuredirect/service_findParentProductId');
        $service->setStoreId($this->getCurrentStore()->getId());

        return $service;
    }
}
