<?php
%php_file_header%
namespace %namespace%\Ui\DataProvider\Catalog\Product\Form\Modifier;

use Magento\Ui\Component\Form;

class %model%Listing extends \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier
{
    /**
     *
     */
    const GROUP_%model.strtoupper% = '%model.strtolower%';

    /**
     *
     */
    public function __construct(
        \Magento\Catalog\Model\Locator\LocatorInterface $locator,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\View\Layout $layout
    ) {
        $this->locator = $locator;
        $this->layout = $layout;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @inheritdoc
     */
    public function modifyMeta(array $meta)
    {
        
        $meta[static::GROUP_%model.strtoupper%] = [
            'children' => [
                'catalog_product_%module.strtolower%_%model.strtolower%_listing' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'autoRender' => true,
                                'componentType' => 'insertListing',
                                'dataScope' => 'catalog_product_%module.strtolower%_%model.strtolower%_listing',
                                'externalProvider' => 'catalog_product_%module.strtolower%_%model.strtolower%_listing_data_source',
                                'selectionsProvider' => 'catalog_product_%module.strtolower%_%model.strtolower%_listing.%model%_columns.ids',
                                'ns' => 'catalog_product_%module.strtolower%_%model.strtolower%_listing',
                                'render_url' => $this->urlBuilder->getUrl('mui/index/render'),
                                'realTimeLink' => false,
                                'behaviourType' => 'simple',
                                'externalFilterMode' => true,
                                /*
                                'imports' => [
                                    'productId' => '${ $.provider }:data.product.current_product_id',
                                    '__disableTmpl' => ['productId' => false],
                                ],
                                'exports' => [
                                    'productId' => '${ $.externalProvider }:params.current_product_id',
                                    '__disableTmpl' => ['productId' => false],
                                ],*/
                            ],
                        ],
                    ],
                ],
            ],
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('%module%: %model%'),
                        'collapsible' => true,
                        'opened' => false,
                        'componentType' => Form\Fieldset::NAME,
                        'sortOrder' => 100,
                    ],
                ],
            ],
        ];

        return $meta;
    }
    
    /**
     * @inheritDoc
     */    
    public function modifyData(array $data)
    {
        return $data;
    }
}
