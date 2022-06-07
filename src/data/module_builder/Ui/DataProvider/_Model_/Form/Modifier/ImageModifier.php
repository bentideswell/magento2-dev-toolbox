<?php
%php_file_header%
namespace %namespace%\Ui\DataProvider\%model%\Form\Modifier;

class ImageModifier implements \Magento\Ui\DataProvider\Modifier\ModifierInterface
{
    /**
     *
     */
    public function __construct(
        \%namespace%\Model\%model%\FileProcessor $fileProcessor
    ) {
        $this->fileProcessor = $fileProcessor;
    }
    
    /**
     * @inheritDoc
     */
    public function modifyData(array $data)
    {
        foreach ($data as $id => $item) {
            if (!empty($item['image'])) {
                $data[$id]['image'] = $this->modifyImageUrl($image);
            }
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function modifyMeta(array $meta)
    {
        return $meta;
    }
    
    /**
     *
     */
    private function modifyImageUrl($image)
    {
        if ($imagePath = $this->fileProcessor->getImagePath($image)) {
            $imageUrl = $this->fileProcessor->getImageUrl($image);
                         
            return [
                [
                    'name' => $image,
                    'url' => $imageUrl,
                    'size' => is_file($imagePath) ? filesize($imagePath) : 0,
                    'type' => 'image',
                ]
            ];
        }
        
        return '';
    }
}