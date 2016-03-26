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
 * Class Semaio_SearchSkuRedirect_Test_Model_Service_FindProductBySku
 *
 * @group Semaio_SearchSkuRedirect
 */
class Semaio_SearchSkuRedirect_Test_Model_Service_FindProductBySku extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Semaio_SearchSkuRedirect_Model_Service_FindProductBySku
     */
    private $subject;

    /**
     * Set up test class
     */
    protected function setUp()
    {
        parent::setUp();
        $this->subject = Mage::getModel('semaio_searchskuredirect/service_findProductBySku');
        $this->subject->setStoreId(self::app()->getStore()->getId());
    }

    /**
     * @test
     * @loadFixture ~Semaio_SearchSkuRedirect/catalog
     * @doNotIndexAll
     */
    public function executeNoProductFound()
    {
        $this->assertFalse($this->subject->execute('1123456'));
    }

    /**
     * @test
     * @loadFixture ~Semaio_SearchSkuRedirect/catalog
     * @doNotIndexAll
     */
    public function executeProductDisabled()
    {
        $this->assertFalse($this->subject->execute('654321'));
    }

    /**
     * @test
     * @loadFixture ~Semaio_SearchSkuRedirect/catalog
     * @doNotIndexAll
     */
    public function execute()
    {
        $product = $this->subject->execute('123456');
        $this->assertInstanceOf('Mage_Catalog_Model_Product', $product);
        $this->assertEquals(1, $product->getId());
    }
}
