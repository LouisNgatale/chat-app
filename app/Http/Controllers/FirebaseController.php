<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    //
    public function index() {


    }

     public static function store($image) {
        $storage = app('firebase.storage');
        $storageClient = $storage->getStorageClient();
        $bucket = $storage->getBucket();

         try {
            $bucket->upload(file_get_contents($_FILES['imageToUpload']['tmp_name']),
                [
                    'name' => $_FILES['imageToUpload']['name']
                ]);
            return "Image uploaded";
         }catch (FirebaseException $exception){
             return $exception;
         }
    }
}
