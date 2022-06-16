<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Artisan;
use Config;
use Google\Cloud\Storage\StorageClient;


class HomeController extends Controller
{

    public function googleCloud($file)
    {

        // $this->validate($request, [
        //     'userfile' => 'required|image|max:2048'
        //     ]);

        $googleConfigFile = file_get_contents(config_path('upload-html-352716-2b895b4f31a7.json'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
      
        $storageBucketName = config('cloudstorage.storage_bucket');
        $bucket = $storage->bucket($storageBucketName);
        // $fileSource = fopen($file, 'r');
        $filename =$file->getClientOriginalName();
        // dd($filename);
        // dd($storageBucketName);
        $newFolderName = date("Y-m-d").'_'.date("H:i:s");
        $googleCloudStoragePath = $newFolderName.'/'.$filename;
        
        /* Upload a file to the bucket.
        Using Predefined ACLs to manage object permissions, you may
        upload a file and give read access to anyone with the URL.*/
        $bucket->upload($file, [
        'predefinedAcl' => 'publicRead',
        'name' => $googleCloudStoragePath
        ]);
        

        
    }
    
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
            $bucketKey = $request->bucket_skey;
            $bucketSecretkey = $request->bucket_key;
            


            #credentials for google cloud
            $azureName;
            $azureKey;
            $azureContainer;


            #credentials for azure
           
            $this->googleCloud($file);
            $this->amazonUpload($file, $bucketName,$bucketKey,$bucketSecretkey,$filePath);
            $this->azureUpload($file,$filePath);

            return back()->withSuccess('File uploaded successfully');

            }
           
    }

    public function amazonUpload($file, $bucket_name, $bucket_key, $bucket_secretkey, $filePath){
            
            Config::set('filesystems.disks.s3.bucket',$bucket_name);
            Config::set('filesystems.disks.s3.secret',$bucket_secretkey);
            Config::set('filesystems.disks.s3.key',$bucket_key);
            Storage::disk('s3')->put($filePath, file_get_contents($file));
    }

    public function azureUpload($file,$filePath){
    
         
            $fileName = time().'_'.$file->getClientOriginalName();
            Config::set('filesystems.disks.azure.name',$bucket_name);
            Config::set('filesystems.disks.azure.key',$bucket_secretkey);
            Config::set('filesystems.disks.azure.container',$bucket_key);
            // save file to azure blob virtual directory uplaods in your container
            // Storage::disk('azure')->put($filePath, file_get_contents($file));
            $filePath = $file->storeAs('htmlUpload/', $fileName, 'azure');

            
        
   }



}