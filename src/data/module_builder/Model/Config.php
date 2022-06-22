<?php
%php_file_header%
namespace %namespace%\Model;

class Config
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $_scopeConfig = null;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $urlBuilder = null;

    /**
     *
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return bool
     */
    public function isSomeValueABool(): bool
    {
        return $this->_scopeConfig->isSetFlag(
            'path/to/config',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getValueFromConfig()
    {
        return $this->_scopeConfig->isSetFlag(
            'path/to/config',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
