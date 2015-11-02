<?php 

namespace Common\Blade;

use Illuminate\View\Engines\EngineResolver;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Illuminate\Events\Dispatcher;
use Yii;
class Blade{

	public $cacheDirectory;
	public $viewPath;
	public $view ;

	public  function render($view, $file,$params){
		$this->cacheDirectory = Yii::$app->getBasePath()."/cache";
		$this->viewPath = Yii::$app->getViewPath();
		$this->view = str_replace($this->viewPath.'\\',"",$file);
		$this->view = substr($this->view ,0,strrpos($this->view , '.'));
		
		$resolver = new EngineResolver();
		$files = new Filesystem();
		$compiler = new BladeCompiler($files, $this->cacheDirectory);
		$engine = new CompilerEngine($compiler);
		
		$resolver->register('blade', function () use ($engine) {
			return $engine;
		});
	
		$viewFinder = new FileViewFinder($files, array($this->viewPath));
		$factory = new Factory($resolver, $viewFinder, new Dispatcher());
		$path = $viewFinder->find($this->view);
		$view = new View($factory, $engine, $this->view, $path, $params);
		$factory->callCreator($view);
		echo  $view->render();die;
	}
}
?>