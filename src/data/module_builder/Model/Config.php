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
     *
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->_scopeConfig = $scopeConfig;
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
