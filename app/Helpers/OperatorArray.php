<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 07/12/20
 * Time: 06:54 ص
 */

namespace App\Helpers;


use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait OperatorArray
{

    public function removeEmptyInArray($array=[]){
       return  array_filter($array, function($value) {
            if( !is_null($value) && $value !== ''){
                return $value;
            }
        } );
    }

    public function ImageUpload($string, $width = null)
    {
        if ($string != null && Str::contains($string, 'base64')) {
            if ($width == null) {
                $width = Image::make($string)->getWidth();
            }
            $ex = explode('/', explode(';', $string)[0])[1];
            // dd($ex);
            $name = 'images/upload/' . uniqid() . '.' . $ex;
            Image::make($string)->resize($width, null, function ($r) {
                $r->aspectRatio();
            })/*->encode('webp', 100)*/
            ->save(storage_path('app/public/' . $name));
            return $name;
        }
        return $string;
    }

}