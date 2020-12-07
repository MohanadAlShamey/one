<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 07/12/20
 * Time: 06:54 ص
 */

namespace App\Helpers;


trait OperatorArray
{

    public function removeEmptyInArray($array=[]){
       return  array_filter($array, function($value) {
            if( !is_null($value) && $value !== ''){
                return $value;
            }
        } );
    }

}