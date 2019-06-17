<?php
/**
 * Created by PhpStorm.
 * User: 旭
 * Date: 2019/6/12
 * Time: 8:49
 */

$str = 'asdqweasdzxc';

$pattern = '/asd/';
//   不可以作为定界符的 是 a-z A-Z 0-9 ' '空格 \ 反斜线
//推荐使用 '/regular/'

var_dump( preg_match($pattern,$str,$result));

var_dump($result);