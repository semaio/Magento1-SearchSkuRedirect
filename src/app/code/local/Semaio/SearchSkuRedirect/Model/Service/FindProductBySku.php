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
 * Class Semaio_SearchSkuRedirect_Model_Service_FindProductBySku
 */
class Semaio_SearchSkuRedirect_Model_Service_FindProductBySku
{
    /**
     * @var int
     */
    private $storeId = null;

    /**
     * Find the product for the given sku
     *
     * @param  string $sku SKU
     * @return bool|Mage_Catalog_Model_Product
     */
    public function execute($sku)
    {
        // Retrieve the product id for the searched text
        $productId = Mage::getModel('catalog/product')->getIdBySku($sku);
        if (!$productId) {
            return false;
        }

        /** @var Mage_Catalog_Model_Product $product */
        $product = Mage::getModel('catalog/product');
        $product->setStoreId($this->getStoreId());
        $product->load($productId);

        // Check if product is enabled
        if ($product->getData('status') != Mage_Catalog_Model_Product_Status::STATUS_ENABLED) {
            return false;
        }

        return $product;
    }

    /**
     * Retrieve the store id
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * Set the store id
     *
     * @param int $storeId Store Id
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
    }
}
