<?php
/**
 * Created by PhpStorm.
 * User: 旭
 * Date: 2019/6/14
 * Time: 11:33
 */

include_once 'File.php';


$downloadFileClass = new \file\File();
//$downloadFileClass->setFilename('123.7z');
//$downloadFileClass->setFileInfo('upload_file/myGame/');
//$downloadFileClass->downloadFile();
if (!empty($_FILES)) {
    $downloadFileClass->setFile($_FILES['file']);
    $downloadFileClass->setFile($_FILES['file1']);
}


var_dump($downloadFileClass->getFile());

$downloadFileClass->setFileSavePath('upload_file/myName/');
$downloadFileClass->uploadFile();

