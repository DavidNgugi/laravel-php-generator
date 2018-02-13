<?php

namespace DavidNgugi\Generator\Logic;

use DavidNgugi\Generator\Logic\CorrectPath;
/**
* Class StubReader Reads and interprates stub templates
*/
class StubReader
{
	use CorrectPath;

	private $stub_path;

	public function __construct()
	{
		$this->stub_path = __DIR__.'\\..\\Stubs';
	}

	/**
	 * Checks if the Stubs directory exists
	 * @return boolean 
	*/
	protected function checkStubPath()
	{
		if ( !is_dir($this->stub_path)) {
            throw new \RuntimeException(sprintf('The directory "%s" does not exist. Re-install this package and try again', $this->stub_path));
        }
		return true;
	}

	/**
	 * Generates new file contents from the stub files
	 * @param path {string}
	 * @param class_name {string}
	 * @param extend_info {array}
	 * @param interface_info {array}
	 * @return string
	*/
	protected function generateClassContent($path, $class_name, $extend_info = [], $interface_info = [])
	{
		$has_extend = (count($extend_info) > 0);
		$extend_path = ($has_extend) ? $extend_info['path']."\\".$extend_info['name'] : ""; 
		$has_interface = (count($interface_info) > 0);
		$interface_path = ($has_interface) ? $interface_info['path']."\\".$interface_info['name'] : ""; 
		$path_to_class = $path;

		$path_to_extend_class = ($has_extend) ? (($extend_info["in_app"]) ? $this->correctToAppPath($extend_path) : $this->correct($extend_path)) : null;

		$path_to_interface = ($has_interface) ? (($interface_info["in_app"]) ? $this->correctToAppPath($interface_path) : $this->correct($interface_path)) : null;

		// Build data array
		$data = [
					"path_to_class" 		=> $path_to_class,
					"class_name"			=> $class_name,
					"path_to_extend_class"	=> $path_to_extend_class,
					"extend_class"			=> ($has_extend) ? $extend_info['name'] : null,
					"path_to_interface"		=> $path_to_interface."Interface",
					"interface_name"		=> ($has_interface) ? $interface_info['name']."Interface" : null
				];

		// Generate the right content
		if($has_extend && $has_interface){
			$content = $this->getStubFile('ClassExtendsImplements');
		}else if (!$has_extend && $has_interface){
			$content = $this->getStubFile('ClassImplements');
		}else if ($has_extend && !$has_interface){
			$content = $this->getStubFile('ClassExtends');
		}else{
			$content = $this->getStubFile('Class');
		}

		// Replace the necessary sections
		return $this->replaceStub($content, $data);
	}

	/**
	 * Generates new interface and trait file contents from the stub files
	 * @param name {string}
	 * @param path {string}
	 * @return new_content {string} 
	*/
	protected function generateInterfaceTraitContent($name, $path, $type)
	{
		$name = ($type == "i") ? $name."Interface" : $name;
		$path_to_interface = $this->correctToAppPath($path);
		$path_to_trait = $this->correctToAppPath($path);
		$data = [
					"path_to_interface"		=> $path_to_interface,
					"interface_name"		=> $name,
					"path_to_trait"			=> $path_to_trait,
					"trait_name"			=> $name
				];
		$content = ($type == "i") ? $this->getStubFile('Interface') : $this->getStubFile('Trait');
		return $this->replaceStub($content, $data);
	}
	
	/**
	 * Checks if the given stub file exists, if so it gets the contents
	 * @param stub_name {string}
	 * @return stub_contents {string}
	*/
	private function getStubFile($stub_name)
	{
		if($this->checkStubPath()){
			$file = $this->stub_path."\\".$stub_name.".stub";
			if(file_exists($file) ){
				return file_get_contents($file);
			}else{
			 	throw new \RuntimeException(sprintf('The file "%s" does not exist. Re-install this package and try again', $file));
			}
		}
	}

	/**
	 * Replace stubs with actual values
	 * @param stub_content {string}
	 * @param data {array}
	 * @return stub_content {string}
	*/
	private function replaceStub($stub_content, $data = [])
	{
		foreach($data as $key => $value)
		{
			$stub_content = str_replace('{'.$key.'}', $value , $stub_content);
		}
		return $stub_content;
	}
}