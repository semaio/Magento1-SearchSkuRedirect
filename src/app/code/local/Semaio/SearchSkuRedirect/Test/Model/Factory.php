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
 * Class Semaio_SearchSkuRedirect_Test_Model_Factory
 *
 * @group Semaio_SearchSkuRedirect
 */
class Semaio_SearchSkuRedirect_Test_Model_Factory extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Semaio_SearchSkuRedirect_Model_Factory
     */
    private $subject;

    /**
     * Set up test class
     */
    protected function setUp()
    {
        parent::setUp();
        $this->subject = Mage::getModel('semaio_searchskuredirect/factory');
    }

    /**
     * @test
     */
    public function getCurrentStore()
    {
        $this->assertInstanceOf('Mage_Core_Model_Store', $this->subject->getCurrentStore());
    }

    /**
     * @test
     */
    public function getCatalogSearchHelper()
    {
        $this->assertInstanceOf('Mage_CatalogSearch_Helper_Data', $this->subject->getCatalogSearchHelper());
    }

    /**
     * @test
     */
    public function getConfig()
    {
        $this->assertInstanceOf('Semaio_SearchSkuRedirect_Model_Config', $this->subject->getConfig());
    }

    /**
     * @test
     */
    public function getServiceFindProductIdBySku()
    {
        $this->assertInstanceOf(
            'Semaio_SearchSkuRedirect_Model_Service_FindProductBySku',
            $this->subject->getServiceFindProductBySku()
        );
    }

    /**
     * @test
     */
    public function getServiceFindParentProductId()
    {
        $this->assertInstanceOf(
            'Semaio_SearchSkuRedirect_Model_Service_FindParentProductId',
            $this->subject->getServiceFindParentProductId()
        );
    }
}
