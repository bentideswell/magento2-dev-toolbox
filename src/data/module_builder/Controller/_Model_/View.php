<?php
%php_file_header%
namespace %namespace%\Controller\%model%;

class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var 
     */
    private $_coreRegistry = null;

    /**
     * @var 
     */
    private $%model.strtolower%Repository = null;

    /**
     * @var 
     */
    private $config = null;

    /**
     *
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Registry $_coreRegistry,
        \%namespace%\Model\%model%Repository $%model.strtolower%Repository,
        \%namespace%\Model\Config $config,
    ) {
        $this->_coreRegistry = $_coreRegistry;
        $this->%model.strtolower%Repository = $%model.strtolower%Repository;
        $this->config = $config;
        
        parent::__construct($context);
    }
    
    /**
     *
     */
    public function execute()
    {
        $%model.strtolower% = $this->%model.strtolower%Repository->getById(
            (int)$this->_request->getParam('id')
        );
        
        $resultPage = $this->resultFactory->create(
            \Magento\Framework\Controller\ResultFactory::TYPE_PAGE
        );
        
        $pageConfig = $resultPage->getConfig();
        
        // Setup layout handles
        $resultPage->addHandle('%module.strtolower%_%model.strtolower%_view');
        $pageConfig->getTitle()->set($%model.strtolower%->getName());
        $pageConfig->setDescription($%model.strtolower%->getMetaDescription());

        if ($pageMainTitle = $resultPage->getLayout()->getBlock('page.main.title')) {
            $pageMainTitle->setPageTitle($%model.strtolower%->getName());
        }  

        $pageConfig->addRemotePageAsset($%model.strtolower%->getUrl(), 'canonical', ['attributes' => ['rel' => 'canonical']]);

        if ($breadcrumbsBlock = $resultPage->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb('home', [
                'label' => __('Home'),
                'title' => __('Home'),
                'link' => '/',
            ]);
            
            $breadcrumbsBlock->addCrumb('%model.strtolower%_index', [
                'label' => __('%model%'),
                'title' => __('%model%'),
                'link' => '/%module.strtolower%/',
            ]);
            
            $breadcrumbsBlock->addCrumb('%model.strtolower%', [
                'label' => __($%model.strtolower%->getName()),
                'title' => __($%model.strtolower%->getName())
            ]);
        }
        
        return $resultPage;
    }
}
