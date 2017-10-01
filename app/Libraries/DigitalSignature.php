<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;
use Session;

class DigitalSignature
{

    private $file_name_to_save;

    function saveSignatureToDiskAsImage($input_image, $pth_to_save_file)
    {
        $json = $input_image;
        $img = $this->sigJsonToImage($json);
        imagepng($img, $pth_to_save_file);
        return;
    }

    //
    function sigJsonToImage($json, $options = [])
    {
        $defaultOptions = [
            'imageSize' => [439, 90]
            ,'bgColour' => [0xff, 0xff, 0xff]
            ,'penWidth' => 2
            ,'penColour' => [0x14, 0x53, 0x94]
            ,'drawMultiplier'=> 12
        ];

        $options = array_merge($defaultOptions, $options);

        $img = imagecreatetruecolor($options['imageSize'][0] * $options['drawMultiplier'], $options['imageSize'][1] * $options['drawMultiplier']);

        if ($options['bgColour'] == 'transparent') {
            imagesavealpha($img, true);
            $bg = imagecolorallocatealpha($img, 0, 0, 0, 127);
        } else {
            $bg = imagecolorallocate($img, $options['bgColour'][0], $options['bgColour'][1], $options['bgColour'][2]);
        }

        $pen = imagecolorallocate($img, $options['penColour'][0], $options['penColour'][1], $options['penColour'][2]);
        imagefill($img, 0, 0, $bg);

        if (is_string($json)) {
            $json = json_decode(stripslashes($json));
        }

        foreach ($json as $v) {
            $this->drawThickLine($img, $v->lx * $options['drawMultiplier'], $v->ly * $options['drawMultiplier'], $v->mx * $options['drawMultiplier'], $v->my * $options['drawMultiplier'], $pen, $options['penWidth'] * ($options['drawMultiplier'] / 2));
        }

        $imgDest = imagecreatetruecolor($options['imageSize'][0], $options['imageSize'][1]);

        if ($options['bgColour'] == 'transparent') {
            imagealphablending($imgDest, false);
            imagesavealpha($imgDest, true);
        }

        imagecopyresampled($imgDest, $img, 0, 0, 0, 0, $options['imageSize'][0], $options['imageSize'][0], $options['imageSize'][0] * $options['drawMultiplier'], $options['imageSize'][0] * $options['drawMultiplier']);
        imagedestroy($img);

        return $imgDest;
    }

    /**
     *  Draws a thick line
     *  Changing the thickness of a line using imagesetthickness doesn't produce as nice of result
     *
     *  @param object $img
     *  @param int $startX
     *  @param int $startY
     *  @param int $endX
     *  @param int $endY
     *  @param object $colour
     *  @param int $thickness
     *
     *  @return void
     */
    function drawThickLine($img, $startX, $startY, $endX, $endY, $colour, $thickness)
    {
        $angle = (atan2(($startY - $endY), ($endX - $startX)));

        $dist_x = $thickness * (sin($angle));
        $dist_y = $thickness * (cos($angle));

        $p1x = ceil(($startX + $dist_x));
        $p1y = ceil(($startY + $dist_y));
        $p2x = ceil(($endX + $dist_x));
        $p2y = ceil(($endY + $dist_y));
        $p3x = ceil(($endX - $dist_x));
        $p3y = ceil(($endY - $dist_y));
        $p4x = ceil(($startX - $dist_x));
        $p4y = ceil(($startY - $dist_y));

        $array = [0=>$p1x, $p1y, $p2x, $p2y, $p3x, $p3y, $p4x, $p4y];
        imagefilledpolygon($img, $array, (count($array)/2), $colour);
    }
}
