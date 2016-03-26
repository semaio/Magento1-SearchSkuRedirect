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
 * Class Semaio_SearchSkuRedirect_Test_Model_Observer_Redirect
 *
 * @group Semaio_SearchSkuRedirect
 */
class Semaio_SearchSkuRedirect_Test_Model_Observer_Redirect extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Semaio_SearchSkuRedirect_Model_Observer_Redirect
     */
    private $subject;

    /**
     * Set up test class
     */
    protected function setUp()
    {
        parent::setUp();
        $this->subject = Mage::getModel('semaio_searchskuredirect/observer_redirect');
    }

    /**
     * @test
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Semaio_SearchSkuRedirect_Model_Observer_AbstractObserver', $this->subject);
        $this->assertInstanceOf('Semaio_SearchSkuRedirect_Model_Factory', $this->subject->getFactory());
    }

    /**
     * @test
     * @loadFixture
     */
    public function executeFeatureDisabled()
    {
        $observerMock = $this->getModelMock('semaio_searchskuredirect/observer_redirect', ['performRedirect']);
        $observerMock->expects($this->never())->method('performRedirect');

        $event = new Varien_Event();
        $observer = new Varien_Event_Observer();
        $observer->setEvent($event);

        $observerMock->execute($observer);
    }

    /**
     * @test
     * @loadFixture ~Semaio_SearchSkuRedirect/catalog
     * @loadFixture
     * @doNotIndexAll
     */
    public function executeNoProductFound()
    {
        $catalogsearchHelperMock = $this->getHelperMock('catalogsearch', ['getQueryText']);
        $catalogsearchHelperMock->expects($this->any())->method('getQueryText')->will($this->returnValue('abcdef'));
        $this->replaceByMock('helper', 'catalogsearch', $catalogsearchHelperMock);

        $observerMock = $this->getModelMock('semaio_searchskuredirect/observer_redirect', ['performRedirect']);
        $observerMock->expects($this->never())->method('performRedirect');

        $event = new Varien_Event();
        $observer = new Varien_Event_Observer();
        $observer->setEvent($event);

        $observerMock->execute($observer);
    }

    /**
     * @test
     * @loadFixture ~Semaio_SearchSkuRedirect/catalog
     * @loadFixture
     * @doNotIndexAll
     */
    public function executeProductEnabledAndVisible()
    {
        $catalogsearchHelperMock = $this->getHelperMock('catalogsearch', ['getQueryText']);
        $catalogsearchHelperMock->expects($this->any())->method('getQueryText')->will($this->returnValue('123456'));
        $this->replaceByMock('helper', 'catalogsearch', $catalogsearchHelperMock);

        $observerMock = $this->getModelMock('semaio_searchskuredirect/observer_redirect', ['performRedirect']);
        $observerMock->expects($this->once())->method('performRedirect');

        $event = new Varien_Event();
        $observer = new Varien_Event_Observer();
        $observer->setEvent($event);

        $observerMock->execute($observer);
    }

    /**
     * @test
     * @loadFixture ~Semaio_SearchSkuRedirect/catalog
     * @loadFixture
     * @doNotIndexAll
     */
    public function executeProductEnabledAndNotVisibleAndParentCheckDisabled()
    {
        $catalogsearchHelperMock = $this->getHelperMock('catalogsearch', ['getQueryText']);
        $catalogsearchHelperMock->expects($this->any())->method('getQueryText')->will($this->returnValue('112233'));
        $this->replaceByMock('helper', 'catalogsearch', $catalogsearchHelperMock);

        $observerMock = $this->getModelMock('semaio_searchskuredirect/observer_redirect', ['performRedirect']);
        $observerMock->expects($this->never())->method('performRedirect');

        $event = new Varien_Event();
        $observer = new Varien_Event_Observer();
        $observer->setEvent($event);

        $observerMock->execute($observer);
    }

    /**
     * @resourceSingleton catalog/product_link
     *
     * @test
     * @loadFixture ~Semaio_SearchSkuRedirect/catalog
     * @loadFixture
     * @doNotIndexAll
     */
    public function executeParentProduct()
    {
        $catalogsearchHelperMock = $this->getHelperMock('catalogsearch', ['getQueryText']);
        $catalogsearchHelperMock->expects($this->any())->method('getQueryText')->will($this->returnValue('112233'));
        $this->replaceByMock('helper', 'catalogsearch', $catalogsearchHelperMock);

        $observerMock = $this->getModelMock('semaio_searchskuredirect/observer_redirect', ['performRedirect']);
        $observerMock->expects($this->once())->method('performRedirect');

        $event = new Varien_Event();
        $observer = new Varien_Event_Observer();
        $observer->setEvent($event);

        $observerMock->execute($observer);
    }

}
