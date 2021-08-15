<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

use function PHPUnit\Framework\isJson;

class Image implements CastsAttributes
{
    /**
     * Add path to the value array(with loop) or string from storage.
     */
    public function get($model, $key, $value, $attributes)
    {
        $images = json_decode($value);
        $path = "https://s3.ap-southeast-1.amazonaws.com/bilions-live/pos-system/";
        if($images && is_array($images)){
          $data = [];
            foreach($images as $image){
                $data[] = $path . $image;
            }
            return $data;
        }
        return $path . $value;
    }

    /**
     * Set the value directly to the storage.
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}