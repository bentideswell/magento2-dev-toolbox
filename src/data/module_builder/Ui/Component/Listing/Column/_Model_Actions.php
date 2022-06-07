<?php
%php_file_header%
namespace %namespace%\Ui\Component\Listing\Column;

class %model%Actions extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     *
     */
    const URL_PATH_EDIT = '%admin_route%/%model.strtolower%/edit';

    /**
     *
     */
    protected $urlBuilder;

    /**
     *
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');

                if (isset($item['%model_id_field%'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_EDIT, ['%model_id_field%' => $item['%model_id_field%']]),
                        'label' => (string)__('Edit')
                    ];
                }
            }
        }

        return $dataSource;
    }
}