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
 * Tests for module config
 *
 * @group Semaio_SearchSkuRedirect
 */
class Semaio_SearchSkuRedirect_Test_Config_Config extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * @test
     * @loadExpections
     */
    public function globalConfig()
    {
        $this->assertModuleVersion($this->expected('module')->getVersion());
        $this->assertModuleCodePool($this->expected('module')->getCodePool());

        foreach ($this->expected('module')->getDepends() as $depend) {
            $this->assertModuleDepends($depend);
        }
    }

    /**
     * @test
     */
    public function testDefinedObservers()
    {
        $this->assertEventObserverDefined(
            Mage_Core_Model_App_Area::AREA_FRONTEND,
            'controller_action_predispatch_catalogsearch_result_index',
            'semaio_searchskuredirect/observer_redirect',
            'execute'
        );
    }
}
