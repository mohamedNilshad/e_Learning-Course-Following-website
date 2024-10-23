<?php
namespace App\Services;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;

class FirebaseService{
    protected $firebaseStorage;

    public function __construct(){
        $firebase = (new Factory)->withServiceAccount(config("firebase.credentials"));
        $this->firebaseStorage = $firebase->createStorage();
    }

    public function uploadFile($filePath, $fileName){
        $bucket = $this->firebaseStorage->getBucket();

        $bucket->upload(
            fopen($filePath, "r"),
            ['name' => $fileName]
        );

        return $this->getPublicUrl($fileName);
    }

    public function getPublicUrl($fileName){
        return 'https://storage.googleapis.com/'. $this->firebaseStorage->getBucket()->name(). '/'. $fileName;
    }

    public function downloadFile($fileName, $destination){
        $bucket = $this->firebaseStorage->getBucket();
        $object = $bucket->object($fileName);
        $object->downloadToFile($destination);
    }
}