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
 *
 * @group Semaio_SearchSkuRedirect
 */
class Semaio_SearchSkuRedirect_Test_Model_Service_FindParentProductId extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Semaio_SearchSkuRedirect_Model_Service_FindParentProductId
     */
    private $subject;

    /**
     * Set up test class
     */
    protected function setUp()
    {
        parent::setUp();
        $this->subject = Mage::getModel('semaio_searchskuredirect/service_findParentProductId');
        $this->subject->setStoreId(self::app()->getStore()->getId());
    }

    /**
     * @test
     * @loadFixture ~Semaio_SearchSkuRedirect/catalog
     * @doNotIndexAll
     */
    public function executeNoParentProductFound()
    {
        $this->assertFalse($this->subject->execute(4));
    }

    /**
     * @test
     * @loadFixture ~Semaio_SearchSkuRedirect/catalog
     * @doNotIndexAll
     */
    public function executeParentProductNotVisible()
    {
        $this->assertFalse($this->subject->execute(2));
    }

    /**
     * @test
     * @loadFixture ~Semaio_SearchSkuRedirect/catalog
     * @doNotIndexAll
     */
    public function execute()
    {
        $product = $this->subject->execute(1);
        $this->assertInstanceOf('Mage_Catalog_Model_Product', $product);
        $this->assertEquals(10, $product->getId());
    }
}
