<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Image;
use Illuminate\Support\Facades\File;

class ImageUpload extends Controller
{
    // Image upload form.
    public function createForm()
    {
        return view('image-upload');
    }

    // Handle image uploading
    public function imageUpload(Request $req)
    {    
        // Image validation
        $this->validate($req,
        [
          'imageFile' => 'required|max:2048',
          'imageFile.*' => 'mimes:jpg,jpeg,png,gif'
        ]);      
        
        if($imageFiles = $req->file('imageFile'))
        {
            foreach($imageFiles as $file)
            {
                $fileName = $file->getClientOriginalName();
                $path = storage_path('app/photos/');

                if(!File::exists($path))
                {
                    File::makeDirectory($path, 0775);
                } 
                
                if($file->move($path, $fileName))
                {
                    $save = Image::create(
                    [
                        'name' => $fileName,
                        'image_path' => $path
                    ]);
                }
            }
            $message = (count($imageFiles) > 1)? "Las imágenes se han subido." : 
              "La imagen se ha subido.";
            return back()->with("success", $message);
        }
    }
}