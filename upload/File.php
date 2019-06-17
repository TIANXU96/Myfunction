<?php
/**
 * Created by PhpStorm.
 * User: 旭
 * Date: 2019/6/13
 * Time: 22:17
 */

namespace file;
//object edit code
class File
{
//    本地文件存路径
    protected $fileSavePath;
//    本地文件文件名
    protected $fileName;
//    上传文件最大值
    protected $maxSize;
//    错误信息
    protected $error;
//    后缀
    protected $ext;
//    上传文件
    protected $file;

    /**
     * File constructor.
     * maxSize 最大值默认为2M
     * allowMime 默认允许上传的文件
     * allowExt 默认允许上传的文件的后缀
     */
    public function __construct()
    {
        $this->maxSize = 8 * pow(1024, 2) * 2;
    }

    /**
     * @param string $Path
     */
    public function setFileSavePath($Path)
    {
        $this->fileSavePath = $Path;
    }

    /**
     * 接收传入文件
     * @param $file
     */
    public function setFile($file)
    {
        $this->file[] = $file;
    }

    public function getFile()
    {
        foreach ($this->file as $item) {
            $file[] = $item;
        }

        return $file;
    }

    /**
     *
     * 'dirname' => 输出去掉文件名的目录
     * 'basename' => 文件名.后缀
     * 'extension' =>  后缀
     * 'filename' => 文件名
     */
    public function setExt()
    {
        foreach ($this->file as $key) {
            $this->ext[] = pathinfo($key['name']);
        }
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }


    /**
     * @return string
     */
    public function checkFile()
    {

        if (!file_exists($this->fileSavePath)) {
            $this->error = '文件路径错误';

            if (!file_exists($this->fileSavePath . $this->fileName)) {
                $this->error = '文件不存在';
            }

        }

        return $this->error;
    }


    public function checkDir()
    {
        if (!file_exists($this->fileSavePath)) {
            mkdir($this->fileSavePath);
        }
    }

    /**
     * 文件上传
     */
    public function uploadFile()
    {
        $this->setExt();
        if (!empty($this->fileSavePath)) {
            $this->checkDir();
            for ($i = 0; $i < count($this->file); $i++) {
                $subFix = $this->ext[$i]['extension'];
                $name = time() . '_' . uniqid() . '.' . $subFix;
                move_uploaded_file($this->file[$i]['tmp_name'], $this->fileSavePath . $name);
                if ($this->file[$i]['error']) {

                    switch ($this->file[$i]['error']) {
//                    错误码替换成易读格式
                        case 1:
                            $this->file[$i]['error'] = $this->file[$i]['name'] . ':超过了PHP配置文件中upload_max_filesize选项的值';
                            break;
                        case 2:
                            $this->file[$i]['error'] = $this->file[$i]['name'] . ':超过了表单中MAX_FILE_SIZE设置的值';
                            break;
                        case 3:
                            $this->file[$i]['error'] = $this->file[$i]['name'] . ':文件部分被上传';
                            break;
                        case 4:
                            $this->file[$i]['error'] = $this->file[$i]['name'] . ':没有选择上传文件';
                            break;
                        case 6:
                            $this->file[$i]['error'] = $this->file[$i]['name'] . ':没有找到临时目录';
                            break;
                        case 7:
                            $this->file[$i]['error'] = $this->file[$i]['name'] . ':文件不可写';
                            break;
                        case 8:
                            $this->file[$i]['error'] = $this->file[$i]['name'] . ':由于PHP的扩展程序中断文件上传';
                            break;
                    }
                } else {
                    echo '文件上传成功';
                }
            }
        } else {
            $this->error = '请设置上传路径';
        }

    }

    /**
     * 文件下载
     */
    public function downloadFile()
    {
        if (empty($this->checkFile())) {
            header("Content-Type:" . filetype($this->fileSavePath . $this->fileName));
            header('content-disposition:attachment;filename=' . basename($this->fileSavePath . $this->fileName));
            header('content-length:' . filesize($this->fileSavePath . $this->fileName));
            readfile($this->fileSavePath . $this->fileName);
        } else {

            $this->error = '错误代码';

        }

    }


}
