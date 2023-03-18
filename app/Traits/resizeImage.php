<?php

namespace App\Traits;

use Intervention\Image\ImageManagerStatic as Image;

trait resizeImage
{
    public static function resizeImage($file_path, $width, $height, $destination_path, $resized_filename, $image_with_watermark = null)
    {
        if ($image_with_watermark != null) {
            $resized = $image_with_watermark;
        } else {
            $resized = Image::make(public_path() . $file_path);
        }

        $resized = $resized->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $result_path = public_path() . $destination_path . $resized_filename;

        $resized->save($result_path);

        $image_sizes = [
            'width' => 0,
            'height' => 0
        ];

        list($image['width'], $image['height']) = getimagesize($result_path);

        $resized_data = [ 
        	'name' => $resized_filename, 
        	'image_path' => $destination_path . $resized_filename,
        	'width' => $image['width'],
            'height' => $image['height']
        ];

        return $resized_data;
    }
}
