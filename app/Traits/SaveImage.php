<?php

namespace App\Traits;

trait SaveImage
{
    private function saveImage($image)
    {
        $imagePath = null;

        if(!is_null($image)){
            $imagePath = $image->store('public/images');
            $imagePath = str_replace('public/','storage/',$imagePath);
        } 

        return $imagePath;
    }
}