<?php
%php_file_header%
namespace %namespace%\Controller\%model%;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     *
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context
    ) {
        parent::__construct($context);
    }
    
    /**
     *
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(
            \Magento\Framework\Controller\ResultFactory::TYPE_PAGE
        );
        
        $pageConfig = $resultPage->getConfig();
        $pageConfig->getTitle()->set($title);
        $pageConfig->setDescription($description);

        if ($pageMainTitle = $resultPage->getLayout()->getBlock('page.main.title')) {
            $pageMainTitle->setPageTitle($title);
        }  

        $pageConfig->addRemotePageAsset($url, 'canonical', ['attributes' => ['rel' => 'canonical']]);
        $resultPage->addHandle($handle);

        if ($breadcrumbsBlock = $resultPage->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb('home', [
                'label' => __('Home'),
                'title' => __('Home'),
                'link' => '/',
            ]);
        }
        
        return $resultPage;
    }
}
