<?php
%php_file_header%
namespace %namespace%\Controller\Adminhtml\%model%;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     *
     */
    const ADMIN_RESOURCE = '%module_name%::resource';

    /**
     *
     */
    protected $resultPageFactory = false;

    /**
     *
     */
    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     *
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('%module_name%::%model.strtolower%');
        $resultPage->getConfig()->getTitle()->prepend(__('%model%'));
        return $resultPage;
    }
}
