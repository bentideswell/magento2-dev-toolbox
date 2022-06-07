<?php
%php_file_header%
namespace %namespace%\Model\Config\Source;

class %model% extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    private $options = null;

    /**
     * @var \%namespace%\Model\ResourceModel\%model%\CollectionFactory
     */
    private $collectionFactory;

    /**
     *
     */
    public function __construct(
        \%namespace%\Model\ResourceModel\%model%\CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        if ($this->options === null) {
            $this->options = [];
            
            foreach ($this->getItems() as $item) {
                $this->options[$item->getId()] = $item->getName();
            }
        }
        
        return $this->options;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray($addEmpty = true)
    {
        $options = [];

        if ($addEmpty) {
            $options[] = ['label' => __('-- Please Select --'), 'value' => ''];
        }

        foreach ($this->getOptions() as $value => $label) {
            $options[] = ['label' => $label, 'value' => $value];
        }

        return $options;
    }

    /**
     * @return array
     */
    public function getAllOptions($addEmpty = true)
    {
        return $this->toOptionArray($addEmpty);
    }
    
    /**
     * @return \%namespace%\Model\ResourceModel\%model%\Collection
     */
    private function getItems(): \%namespace%\Model\ResourceModel\%model%\Collection
    {
        return $this->collectionFactory->create();
    }
}
