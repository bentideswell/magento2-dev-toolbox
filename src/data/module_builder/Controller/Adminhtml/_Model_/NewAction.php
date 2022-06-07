<?php
%php_file_header%
namespace %namespace%\Controller\Adminhtml\%model%;

use Magento\Framework\App\Action\HttpGetActionInterface;

class NewAction extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     * @const string
     */
    const ADMIN_RESOURCE = '%module_name%::resource';

    /**
     * @var \Magento\Backend\Model\View\Result\Forward
     */
    protected $resultForwardFactory;

    /**
     *
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     *
     */
    public function execute()
    {
        return $this->resultForwardFactory->create()->forward('edit');
    }
}
