<?php

namespace LaravelPHPGenerator\Core\Logic;

/**
 * CorrectPath Trait
 * Simple trait to corrects the path
*/

trait CorrectPath {

	/**
	 * Corrects the Path by replacing all 
	 * forward slashes (/) to back slashes (\)
	 * @param path {string}
	 * @return string
	*/
	public function correct($path)
	{
		return str_replace("/", "\\", $path);
	}
	
	/**
	 * Corrects the Path and assumes the path 
	 * starts from the App directory
	 * @param path {string}
	 * @return string
	*/
	public function correctToAppPath($path)
	{
		return "App\\".$this->correct($path);
	}
}