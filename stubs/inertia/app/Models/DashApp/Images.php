<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Images extends Model
{
    use HasFactory;


    public static function makeFromBase64(
        $base64string = '',
        $filename = 'avatar',
        $path = '/uploads/',
        $maxSize = 70,
        $qualitat = 100
    )
    {
        $filename = uniqid($filename . '-' . date("Y-m-d") . '-');

        if (preg_match('/^(?:[data]{4}:(image)\/[a-z]*)/', $base64string)) {
            $parts = explode(";base64,", $base64string);
            $imageparts = explode("image/", @$parts[0]);
            $imagetype = $imageparts[1];
            $imagebase64 = base64_decode($parts[1]);
            $file = $path . $filename . '.' . $imagetype;
            if (Storage::put($file, $imagebase64)) {

                list($width, $height, $type) = getimagesize(Storage::path($file));

                $larger = $width > $height ? $width : $height;
                $smaller = $width > $height ? $height : $width;

                if ($larger <= $maxSize) {
                    $newLarger = $larger;
                    $newSmaller = $smaller;
                } else {
                    $multiplication = $maxSize / $larger;
                    $newLarger = $maxSize;
                    $newSmaller = $smaller * $multiplication;
                }

                $newWidth = $width > $height ? $newLarger : $newSmaller;
                $newHeight = $width > $height ? $newSmaller : $newLarger;

                switch ($type) {
                    case 1:
                        $kep = imagecreatefromgif(Storage::path($file));
                        $extension = 'gif';
                        break;
                    case 2:
                        $kep = imagecreatefromjpeg(Storage::path($file));
                        $extension = 'jpeg';
                        break;
                    case 3:
                        $kep = imagecreatefrompng(Storage::path($file));
                        $extension = 'png';
                        break;
                    case 18:
                        $kep = imagecreatefromwebp(Storage::path($file));
                        $extension = 'webp';
                        break;
                }

                $fileName = $filename . '.' . $extension;

                $newFilePath = Storage::path($path);

                if (!file_exists($newFilePath)) {
                    mkdir($newFilePath, 0777, true);
                }

                $newFileName = $newFilePath . $fileName;

                $ujkep = imagecreatetruecolor($newWidth, $newHeight);

                imagecopyresampled($ujkep, $kep, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                imagejpeg($ujkep, $newFileName, $qualitat);

                return $path . $fileName;
            }
        } else {
            return false;
        }
    }

    public function make($file = null, $filename = 'imagem', $thumb = false)
    {
        $thumb_path = '';
        $imageSize = $file->getSize();
        $imageSize = number_format($imageSize / 1048576, 2);
        $extension = $file->extension();
        $filename = Str::slug($filename);
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $path = $file->storeAs('uploads', $fileNameToStore);
        if ($thumb) {
            $thumb_path = $this->makeThumbnails($path, $filename);
        }
        if ($path) {
            return [
                'file_name' => $filename,
                'image_size' => $imageSize,
                'extension' => $extension,
                'image_path' => $path,
                'thumb_path' => ($thumb_path) ? $thumb_path : '',
            ];
        }
        return false;
    }

    function makeThumbnails($file, $filename = 'thumb_')
    {

        $maxSize = 200;

        $qualitat = 100;

        $path = 'uploads/thumb/';

        list($width, $height, $type) = getimagesize(Storage::path($file));

        $larger = $width > $height ? $width : $height;
        $smaller = $width > $height ? $height : $width;

        if ($larger <= $maxSize) {
            $newLarger = $larger;
            $newSmaller = $smaller;
        } else {
            $multiplication = $maxSize / $larger;
            $newLarger = $maxSize;
            $newSmaller = $smaller * $multiplication;
        }

        $newWidth = $width > $height ? $newLarger : $newSmaller;
        $newHeight = $width > $height ? $newSmaller : $newLarger;

        switch ($type) {
            case 1:
                $kep = imagecreatefromgif(Storage::path($file));
                $extension = 'gif';
                break;
            case 2:
                $kep = imagecreatefromjpeg(Storage::path($file));
                $extension = 'jpeg';
                break;
            case 3:
                $kep = imagecreatefrompng(Storage::path($file));
                $extension = 'png';
                break;
            case 18:
                $kep = imagecreatefromwebp(Storage::path($file));
                $extension = 'webp';
                break;
        }

        $fileName = $filename . time() . '.' . $extension;

        $newFilePath = Storage::path($path);

        if (!file_exists($newFilePath)) {
            mkdir($newFilePath, 0777, true);
        }

        $newFileName = $newFilePath . $fileName;

        $ujkep = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($ujkep, $kep, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagejpeg($ujkep, $newFileName, $qualitat);
        return $path . $fileName;
    }

}
