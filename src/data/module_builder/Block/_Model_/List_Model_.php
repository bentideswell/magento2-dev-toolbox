<?php
%php_file_header%
namespace %namespace%\Block\%model%;

class List%model% extends \Magento\Framework\View\Element\Template
{
    /**
     * @var string
     */
    protected $_template = '%module_name%::%model.strtolower%/list.phtml';
    
    /**
     * @var \%namespace%\Model\ResourceModel\%model%\CollectionFactory
     */
    private $%model.strtolower%CollectionFactory = null;

    /**
     * @var
     */
    private $%model.strtolower%Collection = null;
    
    /**
     *
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \%namespace%\Model\ResourceModel\%model%\CollectionFactory $%model.strtolower%CollectionFactory,
        array $data = []
    ) {
        $this->%model.strtolower%CollectionFactory = $%model.strtolower%CollectionFactory;
        parent::__construct($context, $data);
    }
    
    /**
     * @return \%namespace%\Model\ResourceModel\%model%\Collection
     */
    public function get%model%Collection(): \%namespace%\Model\ResourceModel\%model%\Collection
    {
        if ($this->%model.strtolower%Collection === null) {
            $this->%model.strtolower%Collection = $this->%model.strtolower%CollectionFactory->create();
            
        }
        
        return $this->%model.strtolower%Collection;
    }
}