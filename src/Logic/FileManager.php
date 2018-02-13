<?php

namespace LaravelPHPGenerator\Core\Logic;

use LaravelPHPGenerator\Core\Logic\StubReader;
use LaravelPHPGenerator\Core\Logic\CorrectPath;

use Illuminate\Support\Facades\Storage;

/**
* FileManager Class reads and writes to files using stubs
*/
class FileManager extends StubReader
{
	use CorrectPath;

	/**
	 * Path to app directory 
	 * @var string
	*/
	private $base_path;

	public function __construct()
	{
		$this->base_path = app_path().'/';
		parent::__construct();
	}

	/**
	 * Generates them Files given specific arguments
	 * @param path {string}
	 * @param classes {array}
	 * @param extend info {array}
	 * @param interface info {array}
	 * @return void
	*/
	public function generate($path, $classes, $extend_info = [], $interface_info = [])
	{
		// Make those directories set in the path or you're ...
		$this->evalDirectories($path);

		$path = $this->correctToAppPath($path);

		foreach ($classes as $class) {
			$this->generateClassFile($path, $class, $extend_info, $interface_info);
		}
	}

	/**
	 * Generates them Interface Files given specific arguments
	 * @param interfaces {array}
	 * @param path {string}
	 * @return void
	*/
	public function generateInterface($interfaces, $path)
	{
		// Make those directories set in the path or you're ...
		$this->evalDirectories($path);

		foreach ($interfaces as $interface) {
			$this->generateInterfaceFile($interface, $path);
		}
	}

	/**
	 * Generates them Trait Files given specific arguments
	 * @param traits {array}
	 * @param path {string}
	 * @return void
	*/
	public function generateTrait($traits, $path)
	{
		// Make those directories set in the path or you're ...
		$this->evalDirectories($path);

		foreach ($traits as $trait) {
			$this->generateTraitFile($trait, $path);
		}
	}

	/**
	 * Generates Directories from the specific path
	 * @param relativePath {string} - Namespaced Path 
	 * @return void
	*/
	private function evalDirectories($relativePath)
	{
		// check if this directories exist
		$path = $this->base_path.$relativePath;
		$realPath = $this->directoryExists($path);

		if($realPath == false){
			$dirs = explode("\\", $relativePath);
			$this->checkOrCreateDirs($dirs);
		}
	}
	
	/**
	 * Generates a Class File given specific arguments
	 * @param path {string}
	 * @param class {string}
	 * @param extend info {array}
	 * @param interface info {array}
	 * @return mixed
	*/
	private function generateClassFile($path, $class_name, $extend_info = [], $interface_info = [])
	{
		$content = $this->generateClassContent($path, $class_name, $extend_info, $interface_info);
		$pathToFile = $path."\\".$class_name.".php";
		// Do not save and mess up work if file already exists
		return (!file_exists($pathToFile)) ? $this->writeFile($pathToFile, $class_name, $content) : null;
	}

	/**
	 * Generates an Interface File given specific arguments
	 * @param interface {string}
	 * @param path {string}
	 * @return mixed
	*/
	private function generateInterfaceFile($interface, $path)
	{
		$content = $this->generateInterfaceTraitContent($interface, $path, "i");
		$pathToFile = $this->correctToAppPath($path."\\".$interface."Interface.php");
		// Do not save and mess up work if file already exists
		return (!file_exists($pathToFile)) ? $this->writeFile($pathToFile, $interface, $content) : null;
	}

	/**
	 * Generates an Trait File given specific arguments
	 * @param interface {string}
	 * @param path {string}
	 * @return mixed
	*/
	private function generateTraitFile($trait, $path)
	{
		$content = $this->generateInterfaceTraitContent($trait, $path, "t");
		$pathToFile = $this->correctToAppPath($path."\\".$trait.".php");
		// Do not save and mess up work if file already exists
		return (!file_exists($pathToFile)) ? $this->writeFile($pathToFile, $trait, $content) : null;
	}

	/**
	 * Writes the File to specified path
	 * @param path {string}
	 * @param class_name {string}
	 * @param content {string}
	 * @return boolean
	*/
	private function writeFile($path, $class_name, $content)
    {
    	try{
	        file_put_contents($path, $content);
    	}catch(\RuntimeException $e){
    		\Log::error('[Writing to File]: '. $e->getMessage());
    		throw $e;
    	}

        return true;
    }

    /**
	 * Writes the File to specified path
	 * @param $dirs {array}
	 * @return void
	*/
    private function checkOrCreateDirs($dirs)
    {
    	if(is_array($dirs)){
    		$path = $this->base_path;
    		foreach($dirs as $dir){
	    		if ( !is_dir($path.$dir) && !@mkdir($path.$dir, 0755, true)){
	    				\Log::error("[checkOrCreateDirs()]: ". $dir);
	            		throw new \RuntimeException(sprintf('Could not create directory "%s".', $dir));
        		}else{
        			$path .= "\\".$dir;
        		}
	        }
    	}
    }

    /**
	 * Checks existence of a directory and retrieves the real path
	 * @param directory {string}
	 * @return mixed
	*/
    private function directoryExists($directory)
	{
	    // Get canonicalized absolute pathname
	    $path = realpath($directory);

	    // If it exist, check if it's a directory
	    return ($path !== false AND is_dir($path)) ? $path : false;
	}
}