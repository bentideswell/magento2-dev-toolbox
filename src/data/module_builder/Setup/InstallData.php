<?php
%php_file_header%
namespace %namespace%\Setup;

class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    /**
     * @var Magento\Eav\Setup\EavSetup
     */
    private $eavSetupFactory;
    
    /**
     *
     */
	public function __construct(
	    \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
    ) {
		$this->eavSetupFactory = $eavSetupFactory;
	}
	
	/**
     * @inheritDoc
     */
	public function install(
	    \Magento\Framework\Setup\ModuleDataSetupInterface $setup,
	    \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        /* You might not need this, so just remove if you don't want it */
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
    }    
}
