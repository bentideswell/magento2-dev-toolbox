<?php
//
declare(strict_types=1);

namespace %namespace%\Setup;

class UpgradeData implements \Magento\Framework\Setup\UpgradeDataInterface
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
	public function upgrade(
	    \Magento\Framework\Setup\ModuleDataSetupInterface $setup,
	    \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        // Specify current version below
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
        }
    }
    
    /**
     *
     */
    private function createProductAttribute($eavSetup, $attributeCode, array $data)
    {
        $eavSetup->addAttribute(
			\Magento\Catalog\Model\Product::ENTITY,
			$attributeCode,
			array_merge(
    			[
        			'type' => 'varchar',
        			'backend' => '',
        			'frontend' => '',
        			'input' => 'text',
        			'class' => '',
                    'source' => '',
        			'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
        			'visible' => true,
        			'required' => false,
        			'user_defined' => true,
        			'default' => null,
        			'searchable' => false,
        			'filterable' => false,
        			'comparable' => false,
        			'visible_on_front' => false,
        			'used_in_product_listing' => false,
        			'unique' => false,
        		],
        		$data
            )
		);
    }
}
