<?php

/**
 * store the file.
 *
 * @return string
 */
function uploadImage($image,$path){//file to upload, where to upload

    $url = url()->to("/");
    $fileName = time() .'_'.rand().'.' . $image->extension();
    $image->storeAs('public/'.$path, $fileName);
    return $url.'/storage/'.$path.'/'.$fileName;
}

function sendmail(){

}