<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait ImageTraits
{
    public function deleteFromStorage($imgDisk = null, $imgPath = null, $isArray = false)
    {
        if ($isArray === true) {
            if ($imgDisk && $imgPath) {
                foreach ($imgPath as $key => $value) {
                    if ($value && isset($value) && $value != null) {
                        Storage::disk($imgDisk)->delete($value);
                    }
                }
            }
        } else {
            if ($imgDisk && $imgPath) {
                Storage::disk($imgDisk)->delete($imgPath);
            }
        }

        return true;
    }
}
