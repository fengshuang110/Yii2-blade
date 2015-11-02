# Yii2 Blade

###Yii2更换模板引擎TO blade### 
	在composer.json中添加
	{
    "require-all": true,
    "require": {
	"illuminate/view": "4.2.*"
    	}
	}
	执行composer install 

下载完依赖后在Yii的配置文件中添加引擎的类

	'components' => [
        'view' => [
	        'class' => 'yii\web\View',
	        'defaultExtension' => 'php',
	        'renderers' => [
		        'php' => [
		       		 'class' => 'common\Blade\Blade',//这个类的render方法就是更换的默认引擎的方法
		        ],
	        ],
        ],
    ],



    

  
