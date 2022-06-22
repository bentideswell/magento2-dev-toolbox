<?php
%php_file_header%
namespace %namespace%\Controller;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\ResponseInterface;

class Router implements \Magento\Framework\App\RouterInterface
{
    /**
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \%namespace%\Model\%model%Repository $%model.strtolower%Repository
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \%namespace%\Model\%model%Repository $%model.strtolower%Repository
    ) {
        $this->actionFactory = $actionFactory;
        $this->%model.strtolower%Repository = $%model.strtolower%Repository;
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ActionInterface|null
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $pathInfo = trim($request->getPathInfo(), '/');

        if ($pathInfo === '%module.strtolower%') {
            $request->setModuleName('%module.strtolower%')
                ->setControllerName('index')
                ->setActionName('index')
                ->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $pathInfo);
                
            return $this->actionFactory->create(\Magento\Framework\App\Action\Forward::class);
        }

        return false;
    }
}
