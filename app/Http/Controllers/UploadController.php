<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function store(Request $request)
    {
        if($request->hasFile('photo')){

            $file = $request->file('photo');
            $filename = uniqid(). '-'. now()->timestamp.'.'.$file->extension();
            $folder = 'temp/';
            $full_path = $folder.$filename;

            $file->storeAs($folder, $filename);

            return $filename;
        }

        return '';

    }

    public function delete(){
        return request();
    }

}
