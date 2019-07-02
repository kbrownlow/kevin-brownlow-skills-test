<?php
 
namespace RedAlmond\ButtonsCMSPage\Setup;
 
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \Magento\Cms\Model\PageFactory
     */
    protected $_pageFactory;
 
    /**
     * Construct
     *
     * @param \Magento\Cms\Model\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Cms\Model\PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;
    }
 
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
 
        if (version_compare($context->getVersion(), '1.1') < 0) {
            $page = $this->_pageFactory->create();
            $page->setTitle('Buttons')
                ->setIdentifier('buttons')
                ->setIsActive(true)
                ->setPageLayout('1column')
                ->setStores(array(0))
                ->setContent('
                  <style>.grid {  display: grid; grid-template-columns: 1fr 1fr 1fr; grid-gap: 40px; }</style>
                  <h1>BUTTONS</h1>
                  <div class="grid">
                  <div class="col"><button class="button primary tocart" type="button"><span><span>Load More</span></span></button></div>
                  <div class="col"><button class="button btn-continue" title="Continue Shopping" type="button"><span><span>Continue Shopping</span></span></button></div>
                  <div class="col"><button class="action primary checkout" type="button">Checkout</button></div>
                  </div>
                ')
                ->save();
        }
 
        $setup->endSetup();
    }
}