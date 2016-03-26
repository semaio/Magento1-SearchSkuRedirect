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
 * Class Semaio_SearchSkuRedirect_Test_Model_Config
 *
 * @group Semaio_SearchSkuRedirect
 */
class Semaio_SearchSkuRedirect_Test_Model_Config extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Semaio_SearchSkuRedirect_Model_Config
     */
    private $subject;

    /**
     * Set up test class
     */
    protected function setUp()
    {
        parent::setUp();
        $this->subject = Mage::getModel('semaio_searchskuredirect/config');
    }

    /**
     * @test
     * @loadFixture
     */
    public function isEnabled()
    {
        $this->assertTrue($this->subject->isEnabled());
    }

    /**
     * @test
     * @loadFixture
     */
    public function isCheckParentProductEnabled()
    {
        $this->assertTrue($this->subject->isCheckParentProductEnabled());
    }
}
