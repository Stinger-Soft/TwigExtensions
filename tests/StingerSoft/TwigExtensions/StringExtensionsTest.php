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

use PHPUnit\Framework\TestCase;

class StringExtensionsTest extends TestCase {

	public function testGetFunctions() {
		$extension = new StringExtensions();
		$this->assertCount(4, $extension->getFilters());
		$this->assertContainsOnlyInstancesOf('Twig_SimpleFilter', $extension->getFilters());
	}

	public function testGetName() {
		$extension = new StringExtensions();
		$this->assertEquals('stinger_soft_string_extensions', $extension->getName());
	}


}