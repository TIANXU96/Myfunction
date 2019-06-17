<?php
/**
 * Created by PhpStorm.
 * User: 旭
 * Date: 2019/6/12
 * Time: 8:58
 */

$str = ' asdasdasdq06685wer_=-+_t';

//$pattern = '/asd/';

// \d  匹配0-9
$pattern = '/\d/';
// \D  非0-9 所有
$pattern = '/\D/';
// \w 匹配a-z A-Z _ 0-9
$pattern = '/\w/';
// \W 匹配非a-z A-Z _ 0-9
$pattern = '/\W/';
// 匹配 空格 回车换行 tab
$pattern = '/\s/';
// 非 \s匹配的内容
$pattern = '/\S/';
// [] 原子表  中括号中加^ 表示非
$pattern = '/[^a-z]/';
//  .  除了回车以外都可以匹配到
$pattern = '/./';

var_dump( preg_match($pattern,$str,$result));

var_dump($result);
