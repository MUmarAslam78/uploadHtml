<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Artisan;
use Config;
use Google\Cloud\Storage\StorageClient;
// use pCloud\File;



class HomeController extends Controller
{

    public function upload(Request $request){
       
    // $this->validate($request, [
    //     'userfile' => 'required|html'
    //     ]);
        if ($request->file('userfile')) {
        $file = $request->file('userfile');
        $name = time() . $file->getClientOriginalName();
    
        #credentials for S3
        $filePath = 'htmlUpload/';
        $bucketName = $request->bucket_name;
        $bucketKey = $request->bucket_key;
        $bucketSecretkey = $request->bucket_skey;
    
        #credentials for google cloud
        

        #credentials for azure
        $azureName=$request->azureStorage;
        $azureKey=$request->azureKey;
        $azureContainer=$request->azureContainer;

        #calling functions
        $this->googleCloud($file , $filePath);
        //$this->pCloud($file , $filePath);
        $this->amazonUpload($file, $bucketName,$bucketKey,$bucketSecretkey,$filePath);
        $this->azureUpload($file , $filePath, $azureName , $azureKey , $azureContainer );

        return back()->withSuccess('File uploaded successfully');

        }
           
    }

    # amazon upload
    public function amazonUpload($file, $bucket_name, $bucket_key, $bucket_secretkey, $filePath){
            
        Config::set('filesystems.disks.s3.bucket',$bucket_name);
        Config::set('filesystems.disks.s3.secret',$bucket_secretkey);
        Config::set('filesystems.disks.s3.key',$bucket_key);
        Storage::disk('s3')->put($filePath, $file);
    }

    # azure upload
    public function azureUpload($file , $filePath, $azureName , $azureKey , $azureContainer ){
    
        $fileName = time().'_'.$file->getClientOriginalName();
        Config::set('filesystems.disks.azure.name',$azureName);
        Config::set('filesystems.disks.azure.key',$azureKey);
        Config::set('filesystems.disks.azure.container',$azureContainer);
        Config::set('filesystems.disks.azure.url','https://'.$azureName.'.blob.core.windows.net/');
        $url = $file->storeAs($filePath, $fileName, 'azure');    
   }

   # google cloud upload
   public function googleCloud($file , $filePath){

        $googleConfigFile = file_get_contents(config_path('upload-html-352716-2b895b4f31a7.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        $storageBucketName = config('cloudstorage.storage_bucket');
        $bucket = $storage->bucket($storageBucketName);
        $filename =$file->getClientOriginalName();
        $googleCloudStoragePath = $filePath.$filename;
        $bucket->upload($file, [
        'predefinedAcl' => 'publicRead',
        'name' => $googleCloudStoragePath
        ]);
      
              
    }

     # Pcloud upload
   public function pCloud($file , $filePath){

    $pCloudfile = new File();  
    $fileMetadata = $pCloudfile->upload($file);
    dd($fileMetadata);

          
}


}



