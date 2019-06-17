<?php
/**
 * Created by PhpStorm.
 * User: 旭
 * Date: 2019/3/5
 * Time: 21:45
 */


//自动读取文件夹内文件实现管理
$path = './';

function select_file_in_dir($path, $deep = 0)
{
    $tree = [];
    $resource = opendir($path);
    if ($resource) {
        while ($row = readdir($resource)) {
            if ($row == '.' || $row == '..') {
//                不记录上级目录
                continue;
            } else {
                if (is_dir($row)) {
                    $next_path = $path . $row;
                    $tree['dir_'.$row][$deep] = $row;
                    select_file_in_dir($next_path, $deep++);

                }
                if (is_file($row)) {
                    $tree['file_'.$row][$deep] = $row;
                }
//                    记录文件名

            }
        }
    }

//    return $tree;
}

select_file_in_dir($path, 0);



