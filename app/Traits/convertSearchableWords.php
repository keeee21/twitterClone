<?php

namespace App\Traits;

trait convertSearchableWords
{
  private function convertSearchableWords($keywords){

    if($keywords !== null){
        $search_split = mb_convert_kana($keywords,'s');
        $search_split2 = preg_split('/[\s]+/',$search_split,-1,PREG_SPLIT_NO_EMPTY);

        return $search_split2;
    }
}
}