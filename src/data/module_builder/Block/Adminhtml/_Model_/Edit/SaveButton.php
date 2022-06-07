<?php
%php_file_header%
namespace %namespace%\Block\Adminhtml\%model%\Edit;

class SaveButton implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => '%vendor.strtolower%_%model.strtolower%_form.%vendor.strtolower%_%model.strtolower%_form',
                                'actionName' => 'save',
                                'params' => [
                                    false
                                ]
                            ]
                        ]
                    ]
                ]
            ],
          'sort_order' => 90,
        ];
    }
}
