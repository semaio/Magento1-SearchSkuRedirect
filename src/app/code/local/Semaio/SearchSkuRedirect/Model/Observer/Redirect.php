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
 * Class Semaio_SearchSkuRedirect_Model_Observer_Redirect
 */
class Semaio_SearchSkuRedirect_Model_Observer_Redirect
    extends Semaio_SearchSkuRedirect_Model_Observer_AbstractObserver
{
    /**
     * Perform redirect to product if a product for the search query text is found
     *
     * @param Varien_Event_Observer $observer Observer
     */
    public function execute(Varien_Event_Observer $observer)
    {
        $store = $this->getFactory()->getCurrentStore();
        $storeId = $store->getId();

        // Check if feature is enabled
        if (!$this->getFactory()->getConfig()->isEnabled($store)) {
            return;
        }

        $controllerAction = $observer->getEvent()->getControllerAction();

        // Fetch the query text from the search request
        $query = $this->getFactory()->getCatalogSearchHelper()->getQuery();
        $query->setStoreId($storeId);
        $sku = $query->getQueryText();

        // Find the product for the search sku
        $product = $this->getFactory()->getServiceFindProductBySku()->execute($sku);
        if (!$product) {
            return;
        }

        // Check if product is visible. If yes: perform redirect and stop further processing
        if ($product->getData('visibility') != Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE) {
            $this->performRedirect($controllerAction, $product);

            return;
        }

        /*
         * If the found product is a simple product, check if the product is assigned to an enabled
         * and visible parent product (grouped/configurable product).
         */

        if ($product->getTypeId() == Mage_Catalog_Model_Product_Type::TYPE_SIMPLE
            && $this->getFactory()->getConfig()->isCheckParentProductEnabled($store)
        ) {
            $parentProduct = $this->getFactory()->getServiceFindParentProductId()->execute($product->getId());
            if ($parentProduct) {
                $this->performRedirect($controllerAction, $parentProduct);
            }
        }
    }

    /**
     * Perform the redirect for the given product
     *
     * @param Mage_Core_Controller_Varien_Action $controllerAction Controller Action
     * @param Mage_Catalog_Model_Product         $product          Product
     * @codeCoverageIgnore
     */
    public function performRedirect($controllerAction, Mage_Catalog_Model_Product $product)
    {
        $controllerAction->getResponse()->setRedirect($product->getProductUrl());
    }
}
