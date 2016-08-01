<?php

/*
 * This file is part of the Stinger Twig Extensions package.
 *
 * (c) Oliver Kotte <oliver.kotte@stinger-soft.net>
 * (c) Florian Meyer <florian.meyer@stinger-soft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace StingerSoft\TwigExtensions;

class ArrayExtensionsTest extends \PHPUnit_Framework_TestCase {

	public function testGetFunctions() {
		$extension = new ArrayExtensions();
		$this->assertCount(1, $extension->getFilters());
		$this->assertContainsOnlyInstancesOf('Twig_SimpleFilter', $extension->getFilters());
	}

	public function testGetName() {
		$extension = new ArrayExtensions();
		$this->assertEquals('stinger_soft_array_extensions', $extension->getName());
	}

	public function testUnsetFilter() {
		$extension = new ArrayExtensions();
		$test = range(1, 10);
		$test = array_combine($test, $test);
		$result = $extension->unsetFilter($test, 1);
		$this->assertArrayNotHasKey(1, $result);
		
		$result = $extension->unsetFilter($test, 20);
		$this->assertArrayNotHasKey(20, $result);
		
	}
}