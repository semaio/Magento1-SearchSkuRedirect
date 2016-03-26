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
 * Class Semaio_SearchSkuRedirect_Model_Observer_AbstractObserver
 */
abstract class Semaio_SearchSkuRedirect_Model_Observer_AbstractObserver
{
    /**
     * @var Semaio_SearchSkuRedirect_Model_Factory
     */
    private $factory = null;

    /**
     * Retrieve the factory
     *
     * @return Semaio_SearchSkuRedirect_Model_Factory
     */
    public function getFactory()
    {
        if (null === $this->factory) {
            $this->setFactory(Mage::getModel('semaio_searchskuredirect/factory'));
        }

        return $this->factory;
    }

    /**
     * Set the factory
     *
     * @param Semaio_SearchSkuRedirect_Model_Factory $factory Factory
     */
    public function setFactory($factory)
    {
        $this->factory = $factory;
    }
}
