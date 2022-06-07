<?php
%php_file_header%
namespace %namespace%\Ui\DataProvider\%model%\Form;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     *
     */
    private $pool;
    
    /**
     * @inheritDoc
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \%namespace%\Model\ResourceModel\%model%\CollectionFactory $collectionFactory,
        \Magento\Ui\DataProvider\Modifier\PoolInterface $pool,
        array $meta = [],
        array $data = [],
    ) {
        $this->pool = $pool;
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        $data = parent::getData();
        $items = [];
        
        foreach ($data['items'] as $item) {
            $items[$item['%model_id_field%']] = $item;
        }

        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $items = $modifier->modifyData($items);
        }

        return $items;
    }
}
