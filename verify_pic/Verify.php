<?php
/**
 * Created by PhpStorm.
 * User: 旭
 * Date: 2019/6/15
 * Time: 22:49
 */

class Verify
{
    protected $height;
    protected $width;
    protected $type;
//    字符集
    protected $varCode;
//    验证图片上字符的个数
    protected $count;
//    输出到图片上的字符
    private $code;
//    背景色域
    protected $backgroundGamut;
//    字体色域
    protected $typefaceGamut;
//    图片资源
    protected $img;
//    错误信息
    protected $error;

    public function __construct()
    {
//        配置默认类型类型 为number
        $this->type = 'number';
//        配置默认图片上输出的字符个数
        $this->count = 5;
//        number 纯数字
//        alpha 字母
//        alpha 字母和数字
        $this->varCode = [
            'number' => '0123456789',
            'alpha' => 'abcdefghjkmnopqrstuvwxyz' . strtoupper('abcdefghjklmnopqrstuvwxyz'),
            'alphaNum' => '0123456789abcdefghjklmnopqrstuvwxyz' . strtoupper('abcdefghjklmnopqrstuvwxyz'),
        ];
        $this->height = 25;
        $this->width = 120;
//        设置默认背景色域
        $this->backgroundGamut = '200-256';
//        设置默认字体色域
        $this->typefaceGamut = '1-100';
    }

    /**
     * 设置背景颜色域
     * @param $start
     * @param $end
     */
    public function setBackgroundGamut($start, $end)
    {
        $this->backgroundGamut = $start . '-' . $end;
    }

    /**
     * 设置字体颜色域
     * @param $start
     * @param $end
     */
    public function setTypefaceGamut($start, $end)
    {
        $this->typefaceGamut = $start . '-' . $end;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     *
     * @param mixed $varCode
     */
    public function setVarCode($varCode)
    {
        $this->varCode = $varCode;
        if (!is_array($this->varCode)) {
            $this->error = '验证码字符集输入错误,请以Array格式输入';
            exit();
        }
    }

    /**
     * @return array
     */
    public function getVarCode()
    {
        return $this->varCode;
    }

    /**
     * 输出图片
     * @return mixed
     */
    public function getImg()
    {
        header('Content-type:image/png');
        imagepng($this->img);
        imagedestroy($this->img);
    }

    /**
     * 获取验证码
     * @return string
     */
    public function getCode()
    {
        return strtolower($this->code);
    }

    /**
     * 生成验证码图片上的随机字符
     */
    private function createCode()
    {
        $this->code = str_shuffle($this->varCode[$this->type]);
        $this->code = substr($this->code, 0, $this->count);
    }

    /**
     * 画布或者字体上色
     * @param $colour
     * @return int
     */
    private function colouration($colour)
    {
        $gamut = explode('-', $colour);
        $r = (int)mt_rand($gamut[0], $gamut[1]);
        $g = (int)mt_rand($gamut[0], $gamut[1]);
        $b = (int)mt_rand($gamut[0], $gamut[1]);
        return imagecolorallocate($this->img, $r, $g, $b);
    }


    private function createTypeface()
    {
        $exp = floor($this->width / $this->count);

        for ($i = 0; $i < $this->count; $i++) {
            $x = $exp * $i + $exp / 2 * lcg_value();
            $y = floor($this->height / 2 * lcg_value());
            imagechar($this->img, 5, $x, $y, $this->code[$i], $this->colouration($this->typefaceGamut));
        }
    }

    public function createImg()
    {
//        生成验证码图片
        $this->img = imagecreatetruecolor($this->width, $this->height);
        imagefill($this->img, 0, 0, $this->colouration($this->backgroundGamut));
        $this->createCode();
        $this->createTypeface();

    }

    /**
     * 为图片添加雪花和曲线
     */
    public function createLine()
    {
        $exp = $this->width;
        //线条
        for ($i = 0; $i < 5; $i++) {
            $x = $exp / 2 * lcg_value();
            $y = floor($this->height / 2 * lcg_value());
            $x1 = $exp * lcg_value();
            $y1 = floor($this->height * lcg_value());
            imageline($this->img, $x, $y, $x1, $y1, $this->colouration($this->typefaceGamut));
        }
        //雪花
        for ($i = 0; $i < 20; $i++) {
            $x = $exp * lcg_value();
            $y = floor($this->height / 2 * lcg_value());
            imagestring($this->img, 1, $x, $y, '.', $this->colouration($this->typefaceGamut));
        }
    }
}







