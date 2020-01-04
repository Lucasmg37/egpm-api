<?php


namespace App\Model;


use Gumlet\ImageResize;
use Gumlet\ImageResizeException;

class ResizeImage
{

    /**
     * @param $localFile
     * @param $newname
     * @param $widht
     * @param int $quality
     * @param string $pastasave
     * @return string
     * @throws ImageResizeException
     */
    public static function imageResize($localFile, $newname, $widht, $quality = 80, $pastasave = "upload/")
    {
        try {
            $image = new ImageResize($localFile);
            $image->resizeToWidth($widht);
            $image->save($pastasave . $newname);
            return File::setPathFileLink($pastasave . $newname);

        } catch (ImageResizeException $e) {
            throw $e;
        }
    }

}