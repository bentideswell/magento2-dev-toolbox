<?php
%php_file_header%
namespace %namespace%\Ui\Component\Listing\Column;

class StoreOptions extends \Magento\Store\Ui\Component\Listing\Column\Store\Options
{
    /**
     *
     */
    const ALL_STORE_VIEWS = '0';

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->options !== null) {
            return $this->options;
        }

        $this->currentOptions['All Store Views']['label'] = __('All Store Views');
        $this->currentOptions['All Store Views']['value'] = self::ALL_STORE_VIEWS;
        $this->generateCurrentOptions();
        $this->options = array_values($this->currentOptions);

        return $this->options;
    }
}