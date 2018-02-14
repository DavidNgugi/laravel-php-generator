<?php

namespace Tests\Unit;

use Tests\GeneralTestCase;

class CheckFilesExist extends GeneralTestCase {

    public function __construct(){
        parent::setup();
    }

    public function test_service_provider_file_exists(){
		$path = $this->base_path."LaravelPHPGeneratorServiceProvider.php";
		$this->assertTrue(file_exists($path));
	}

	public function test_test_class_file_exists(){
		$path = $this->base_path."TestClass.php";
		$this->assertTrue(file_exists($path));
	}

	public function test_test_class_is_callable(){
		$s = new \LaravelPHPGenerator\TestClass;
		$this->assertTrue(is_object($s));
	}
	
	public function test_trait_logic_file_exists(){
		$path = $this->base_path."Logic/CorrectPath.php";
		$this->assertTrue(file_exists($path));
	}

	public function test_file_manager_file_exists(){
		$path = $this->base_path."Logic/FileManager.php";
		$this->assertTrue(file_exists($path));
	}

	public function test_Stub_Reader_file_exists(){
		$path = $this->base_path."Logic/StubReader.php";
		$this->assertTrue(file_exists($path));
    }

}