<?php
%php_file_header%
namespace %namespace%\Ui\DataProvider\Catalog\Product\Form;

class %model%DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     *
     */
    protected $collectionFactory;

    /**
     *
     */
    protected $request;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param RequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \%namespace%\Model\ResourceModel\%model%\CollectionFactory $collectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collectionFactory = $collectionFactory;
        $this->collection = $this->collectionFactory->create();
        $this->request = $request;
    }

    /**
     * @inheritdoc
     * @since 100.1.0
     */
    public function getData()
    {
        $this->getCollection()->addFieldToFilter('%model_id_field%', 1);


        $arrItems = [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => [],
        ];

        foreach ($this->getCollection() as $item) {
            $arrItems['items'][] = $item->toArray([]);
        }

        return $arrItems;
    }
}
