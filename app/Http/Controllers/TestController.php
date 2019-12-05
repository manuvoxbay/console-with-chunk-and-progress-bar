<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;

class TestController extends Controller
{
    public function save(Request $request)
    {
      $avatar_image = $request->file('file1');
      if($avatar_image) {
          $avatar_cropped = $request->val;;

          list($type, $avatar_cropped) = explode(';', $avatar_cropped);
          list(, $avatar_cropped)      = explode(',', $avatar_cropped);


          $avatar_cropped = base64_decode($avatar_cropped);
          //$extension = $avatar_image->getClientOriginalExtension();
          $extension = 'png';
          Storage::disk('public')->put($avatar_image->getFilename().'.'.$extension,  $avatar_cropped);
          $data['avatar_image'] = $avatar_image->getFilename().'.'.$extension;
          return "success";
      }
      return "out side";
    }
}
