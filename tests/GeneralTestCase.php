<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class GeneralTestCase extends TestCase {

	protected $base_path;

	public function setup(){
        $this->base_path = __DIR__."/../src";
    }

    public function testSetup(){
        $this->assertTrue(is_dir($this->base_path));
    }

}
