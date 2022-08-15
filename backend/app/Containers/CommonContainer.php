<?php

namespace App\Containers;


class CommonContainer 
{

    public function getFileName($image)
    {
        return time() . '.' . str_replace(' ', '_', strtolower($image->getClientOriginalName()));
    }


    public function getProfilePicPath($folder)
    {
        return public_path() . "/assets/images/".$folder."/";
    }
    public function unlinkProfilePic($file,$folder)
    {
        $file_path = $this->getProfilePicPath($folder);
        $file = $file_path . $file;
        if (file_exists($file)) {
            @unlink($file);
        }

    }
}