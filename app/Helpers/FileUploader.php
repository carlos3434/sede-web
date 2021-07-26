<?php

namespace App\Helpers;

class FileUploader
{
    /** @var Storage */
    private $storage;

    /** @var File */
    private $fileManager;

    /**
     * @var Storage     $storage
     * @var File        $fileManager
     */
    public function __construct(\Illuminate\Support\Facades\Storage $storage , \File $fileManager)
    {
        $this->storage = $storage;
        $this->fileManager = $fileManager;
    }
    /**
     * @var File        $file
     * @var String      $fileFolder
     * @return String   $fileName
     */
    public function upload($file, $fileFolder)
    {
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $this->storage::put('uploads/'.$fileFolder.'/'.$fileName, $this->fileManager::get($file), 'public');
        return $fileName;
    }
    public function uploadStorage($file, $fileFolder, $fileName )
    {
        $this->storage::put('uploads/'.$fileFolder.'/'.$fileName,  $file, 'public');
        return $fileName;
        //$this->storage::disk('tenant')->put('uploads/'.$fileFolder.'/'.$filename, $file_content);
    }
    public function destroyStorage( $fileName )
    {
        $this->storage::delete('uploads/files'.'/'.$fileName );
        //return $fileName;
        //$this->storage::disk('tenant')->put('uploads/'.$fileFolder.'/'.$filename, $file_content);
    }
}