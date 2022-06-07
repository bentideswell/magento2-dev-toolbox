<?php
%php_file_header%
namespace %namespace%\Model;

class %model% extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = '%model_layout_prefix%';
    protected $_eventObject = '%model.strtolower%';

    /**
     *
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $registry, $resource, $resourceCollection);
    }

    /**
     *
     */
    public function _construct()
    {
        $this->_init(\%namespace%\Model\ResourceModel\%model%::class);
        return parent::_construct();
    }
}
