<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait attachfiletrait
{



    // 30:18 video 43

    public function uploadFile($request,$name,$folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/',$folder.'/'.$file_name,'upload_attachments');

        
    }
    // 30:45 video 43

    public function deleteFile($name ,$folder)
    {
        $exists = Storage::disk('upload_attachments')->exists('attachments/'.$folder.'/'.$name);

        if($exists)
        {
            Storage::disk('upload_attachments')->delete('attachments/'.$folder.'/'.$name);
        }
    }
}
