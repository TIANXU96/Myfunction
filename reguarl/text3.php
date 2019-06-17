<?php
/**
 * Created by PhpStorm.
 * User: 旭
 * Date: 2019/6/12
 * Time: 9:09
 */

$str = 'aasdasdaaaasdqwezf';
// * 不会匹配失败 不会返回empty  会返回一个空的数组
$pattern = '/A*/';
// + 匹配多个 a
$pattern = '/a+/';
// ? 匹配 0或者1 个a
$pattern = '/a?/';
// {n,m}   n-m个  m可以不给参数
$pattern = '/a{0,3}/';
// ^ 不在中括号中 是以什么开始    $ 以什么结束   原子修饰符 ↑
$pattern = '/^a.+f$/';

/*----------模式修正符号 写在定界符之后---------*/
// i 不区分大小写
$pattern = '/ASD/i';
// m 视为多行 s 视为单行  换行的字符也可以被匹配
$pattern = '/asd/m';
// U 取消贪婪 比如+匹配出好多个 U 就只要一个
var_dump( preg_match($pattern,$str,$result));

var_dump($result);


//一直匹配到数组结尾
preg_match_all($pattern,$str,$arr);

$replace = 'replace';

$new_str = preg_replace($pattern,$replace,$str);