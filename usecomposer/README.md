修改为国内镜像网站


https://packagist.org/  官方包
https://pkg.phpcomposer.com/ 中国镜像网
https://github.com/         composer去这里找


使用配置文件修改（单个项目修改）
"repositories":{
    "packagist":{
            "type" :"composer",
            "url" :"https://packagist.phpcomposer.com"
    }
}

composer update
指令修改（全局修改）
composer config -g repo.packagist composer https://packagist.phpcomposer.com



composer 常用命令
composer list 查看
