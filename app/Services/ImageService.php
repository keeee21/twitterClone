<?php

namespace App\Services;

class ImageService
{                                   
    public static function upload($imageFile)
    {
        if(!is_null($imageFile) && $imageFile->isValid()){
            $imagePath = $imageFile->store('public/images');
            $iconImage = str_replace('public/','storage/',$imagePath);
        } else {
            $iconImage = null;
        }
    }
}