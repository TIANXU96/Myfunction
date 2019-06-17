<?php
/**
 * Created by PhpStorm.
 * User: 旭
 * Date: 2019/6/15
 * Time: 23:11
 */


include_once 'Verify.php';
$image = new Verify();

$image->createImg();

$image->createLine();

$image->getImg();




