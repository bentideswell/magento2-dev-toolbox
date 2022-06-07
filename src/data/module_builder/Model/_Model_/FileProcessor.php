<?php
%php_file_header%
namespace %namespace%\Model\%model%;

use Magento\Framework\Exception\LocalizedException;
use Magento\Theme\Model\Design\Backend\File;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\Framework\UrlInterface;

class FileProcessor
{
    /**
     * @var UploaderFactory
     */
    protected $uploaderFactory;

    /**
     * Media Directory object (writable).
     *
     * @var WriteInterface
     */
    protected $mediaDirectory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var string
     */
    const FILE_DIR = '%module.strtolower%/%model.strtolower%';

    /**
     * @param UploaderFactory $uploaderFactory
     * @param BackendModelFactory $backendModelFactory
     * @param MetadataProvider $metadataProvider
     * @param Filesystem $filesystem
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->uploaderFactory = $uploaderFactory;
        $this->storeManager = $storeManager;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }
    
    /**
     *
     * @return array
     */
    public function uploadFile($fileId)
    {
        try {
            $result = $this->save($fileId, $this->getTargetUploadPath());
            $result['url'] = $this->getTargetUploadUrl($result['file']);
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $result;
    }

    /**
     * Convert $url ([0 => ['url' => $url]] || ['url' => $url] || $url) into a URL relative to the media dir
     *
     * @return ?string
     */
    public function getInsertValue($url): ?string
    {
        if (is_array($url)) {
            if (isset($url[0]['url'])) {
                $url = $url[0]['url'];
            } elseif (isset($url['url'])) {
                $url = $url;
            }
        }
        
        if (is_array($url)) {
            throw new \RuntimeException(
                'Unable to process insert value for URL. Url is an array (' . print_r($url, true) . ')'
            );
        }

        $url = str_replace(
            $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA),
            '',
            $url
        );

        $url = str_replace('/pub/media/', '', $url);
        $url = preg_replace('/^\/media\//', '', $url);

        return $url;        
    }

    /**
     *
     */
    public function getImageUrl($fileId)
    {
        return $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . $fileId;
    }
    
    /**
     *
     */
    public function getImagePath($fileId): ?string
    {
        $path = $this->mediaDirectory->getAbsolutePath() . ltrim($fileId, '/'); 
        return is_file($path) ? $path : null;
    }
    
    /**
     *
     */
    protected function getTargetUploadUrl($file)
    {
        return $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
            . self::FILE_DIR . '/' . $this->prepareFile($file);
    }

    /**
     * @return string
     */
    private function getTargetUploadPath()
    {
        return $this->mediaDirectory->getAbsolutePath(self::FILE_DIR);
    }
    
    /**
     * Prepare file
     *
     * @param string $file
     * @return string
     */
    protected function prepareFile($file)
    {
        return ltrim(str_replace('\\', '/', $file), '/');
    }


    /**
     * Save image
     *
     * @param string $fileId
     * @param string $destination
     * @return array
     * @throws LocalizedException
     */
    protected function save($fileId, $destination)
    {
        $uploader = $this->uploaderFactory->create(['fileId' => $fileId]);
        $uploader->setAllowRenameFiles(true);
        $uploader->setFilesDispersion(false);
        $uploader->setAllowedExtensions(['png', 'jpeg', 'jpg', 'gif']);

        $result = $uploader->save($destination);
        unset($result['path']);

        return $result;
    }
}
