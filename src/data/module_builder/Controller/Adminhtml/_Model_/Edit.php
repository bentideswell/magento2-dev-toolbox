<?php
%php_file_header%
namespace %namespace%\Controller\Adminhtml\%model%;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    /**
     *
     */
    const ADMIN_RESOURCE = '%module_name%::resource';

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     *
     */
    private $%model.strtolower%Factory;

    /**
     *
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \%namespace%\Model\%model%Factory $%model.strtolower%Factory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->%model.strtolower%Factory = $%model.strtolower%Factory;
        parent::__construct($context);
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('%module_name%::%model.strtolower%');
        return $resultPage;
    }

    /**
     *
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('%model.strtolower%_id');
        $%model.strtolower% = $this->%model.strtolower%Factory->create();

        if ($id && !$%model.strtolower%->load($id)->getId()) {
            $this->messageManager->addErrorMessage(__('This %model.strtolower% no longer exists.'));
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        $this->_coreRegistry->register('%module_name.strtolower%', $%model.strtolower%);

        $resultPage = $this->_initAction();
        
        $title = $resultPage->getConfig()->getTitle()->prepend(
            __(
                '%model%: %1',
                $%model.strtolower%->getId() ? $%model.strtolower%->getName() : __('New')
            )
        );

        return $resultPage;
    }
}