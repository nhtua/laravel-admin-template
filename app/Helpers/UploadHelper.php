<?php
namespace App\Helpers;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;

class UploadHelper
{
	/**
	 * Storage uploaded image and reszie
	 * @param  Symfony\Component\HttpFoundation\File\UploadedFile $file
	 * @return String File path storaged
	 */
	public static function image(UploadedFile $file, $dir = "thumbnails")
	{
		$dirTarget = DIRECTORY_SEPARATOR
                ."upload".DIRECTORY_SEPARATOR
                .$dir.DIRECTORY_SEPARATOR
                .date_create()->format("y".DIRECTORY_SEPARATOR."m".DIRECTORY_SEPARATOR."d".DIRECTORY_SEPARATOR);  
        $fileName = str_random(10).".".$file->getClientOriginalExtension();
        $file->move(public_path().$dirTarget, $fileName);

        $img = Image::make(public_path().$dirTarget.$fileName);
        $width = $img->width();
        $sizes = explode(',', trim(env('IMAGE_SIZES')) );
        foreach ($sizes as $size) {
        	if ($width > $size) {
        		$img->widen($size);
        		$pieces = explode(".", $fileName);
        		$img->save(public_path().$dirTarget.$fileName.".".$size.".".$pieces[1]);
        	}
        }
        return $dirTarget.$fileName;
	}

    /**
     * Remove old images when user upload one new.
     * @param  String $filePath file path of original image.
     * @return Void           No return
     */
    public static function cleanOldImage($filePath)
    {
        $sizes = explode(',', trim(env('IMAGE_SIZES')) );
        $pieces = explode(".", $filePath);    
        foreach ($sizes as $size) {
            @unlink($filePath.".".$size.".".$pieces[count($pieces) - 1]);
        }
        @unlink($filePath);
    }

	 /**
	 * Storage uploaded audio file
	 * @param  Symfony\Component\HttpFoundation\File\UploadedFile $file
	 * @return String File path storaged
	 */
	public static function audio(UploadedFile $file)
	{
		$dirTarget = DIRECTORY_SEPARATOR
                ."upload".DIRECTORY_SEPARATOR
                ."songs".DIRECTORY_SEPARATOR
                .date_create()->format("y".DIRECTORY_SEPARATOR."m".DIRECTORY_SEPARATOR."d".DIRECTORY_SEPARATOR);  
        $fileName = str_random(10).".".$file->getClientOriginalExtension();
        $file->move(public_path().$dirTarget, $fileName);
        return $dirTarget.$fileName;
	}

    /**
     * Storage uploaded image and reszie
     * @param  Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return String File path storaged
     */
    public static function file(UploadedFile $file, $dir = "data")
    {
        $dirTarget = DIRECTORY_SEPARATOR
                ."upload".DIRECTORY_SEPARATOR
                .$dir.DIRECTORY_SEPARATOR
                .date_create()->format("y".DIRECTORY_SEPARATOR."m".DIRECTORY_SEPARATOR."d".DIRECTORY_SEPARATOR);  
        $fileName = str_random(10).".".$file->getClientOriginalExtension();
        $file->move(public_path().$dirTarget, $fileName);

        return [
            'realPath' => $dirTarget.$fileName,
            'fileName' => $file->getClientOriginalName()
        ];
    }
}