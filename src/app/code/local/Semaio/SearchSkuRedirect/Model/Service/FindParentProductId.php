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
 * Class Semaio_SearchSkuRedirect_Model_Service_FindParentProductId
 */
class Semaio_SearchSkuRedirect_Model_Service_FindParentProductId
{
    /**
     * @var int
     */
    private $storeId = null;

    /**
     * Find an enabled and visible parent product (grouped/configurable) for
     * the given simple product id
     *
     * @param  int $productId Product Id
     * @return bool|Mage_Catalog_Model_Product
     */
    public function execute($productId)
    {
        $parentIds = Mage::getModel('catalog/product_type_grouped')->getParentIdsByChild($productId);
        if (count($parentIds) == 0) {
            $parentIds = Mage::getModel('catalog/product_type_configurable')->getParentIdsByChild($productId);
        }

        if (count($parentIds) > 0) {
            foreach ($parentIds as $parentId) {
                /** @var Mage_Catalog_Model_Product $product */
                $product = Mage::getModel('catalog/product');
                $product->setStoreId($this->getStoreId());
                $product->load($parentId);

                if ($product->getData('status') == Mage_Catalog_Model_Product_Status::STATUS_ENABLED
                    && $product->getData('visibility') != Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE
                ) {
                    return $product;
                }
            }
        }

        return false;
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
