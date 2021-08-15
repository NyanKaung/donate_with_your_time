<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;

trait Base64
{
    public function uploadBase64($base64String) {

      // ==== if it's link return that filename substr from that link ====
        if ($this->_isLink($base64String)) {
          $filename = substr($base64String, 64);
          return $filename;
        }

        // ==== else return file name ====
        list($type, $data) = explode(';', $base64String);
        list(, $data)      = explode(',', $data);
        list(, $extension) = explode('/', $type);
        $filename          = time() . uniqid() . rand(1000, 9999) . '.' . $extension;
        Storage::put("pos-system/". $filename,  base64_decode($data), 'public');
        return $filename;
      }
      
      // ==== checking param is link or base64 string ====
      private function _isLink($url) {
        $http = substr($url, 0, 5);
        if (strtolower($http) == 'https') {
          return true;
        }
        return false;
      }
}