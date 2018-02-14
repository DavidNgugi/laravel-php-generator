<?php

namespace Tests\Unit;

use Tests\GeneralTestCase;

class CheckFilesExist extends GeneralTestCase {

    public function __construct(){
        parent::setup();
	}
	
	// Classes 

	public function test_class_LaravelPHPGeneratorServiceProvider_exists()
	{		
		$this->assertTrue(class_exists("\LaravelPHPGenerator\LaravelPHPGeneratorServiceProvider"));
	}

	public function test_class_TestClass_exists(){

		$this->assertTrue(class_exists("\LaravelPHPGenerator\TestClass"));
	}
	
	public function test_class_FileManager_exists()
	{
		$this->assertTrue(class_exists("\LaravelPHPGenerator\Logic\FileManager"));
	}

	public function test_class_StubReader_exists()
	{
		$this->assertTrue(class_exists("\LaravelPHPGenerator\Logic\StubReader"));
	}

	// Traits

	public function test_trait_CorrectPath_exists()
	{
		$this->assertTrue(trait_exists("\LaravelPHPGenerator\Logic\CorrectPath"));
	}
	
	// Commands

	public function test_GenerateClass_Command_exists()
	{
		$this->assertTrue(class_exists("\LaravelPHPGenerator\Commands\GenerateClass"));
	}

	public function test_GenerateInterface_Command_exists()
	{
		$this->assertTrue(class_exists("\LaravelPHPGenerator\Commands\GenerateInterface"));
	}
	public function test_GenerateTrait_Command_exists()
	{
		$this->assertTrue(class_exists("\LaravelPHPGenerator\Commands\GenerateTrait"));
	}

	// Stubs

	public function test_Class_Stub_exists()
	{
		$this->assertTrue(file_exists($this->base_path."/Stubs/Class.stub"));
	}

	public function test_ClassExtends_Stub_exists()
	{
		$this->assertTrue(file_exists($this->base_path."/Stubs/ClassExtends.stub"));
	}

	public function test_ClassExtendsImplements_Stub_exists()
	{
		$this->assertTrue(file_exists($this->base_path."/Stubs/ClassExtendsImplements.stub"));
	}

	public function test_ClassImplements_Stub_exists()
	{
		$this->assertTrue(file_exists($this->base_path."/Stubs/ClassImplements.stub"));
	}

	public function test_Interface_Stub_exists()
	{
		$this->assertTrue(file_exists($this->base_path."/Stubs/Interface.stub"));
	}

	public function test_Trait_Stub_exists()
	{
		$this->assertTrue(file_exists($this->base_path."/Stubs/Trait.stub"));
	}
}