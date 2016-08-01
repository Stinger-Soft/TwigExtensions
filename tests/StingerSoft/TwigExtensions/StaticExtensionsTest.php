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

class StaticExtensionsTest extends \PHPUnit_Framework_TestCase {

	public static $hammerfall = true;

	public static function returnTrue() {
		return true;
	}

	public function testGetFunctions() {
		$extension = new StaticExtensions();
		$this->assertCount(2, $extension->getFunctions());
		$this->assertContainsOnlyInstancesOf('Twig_SimpleFunction', $extension->getFunctions());
	}

	public function testGetName() {
		$extension = new StaticExtensions();
		$this->assertEquals('stinger_soft_static_extensions', $extension->getName());
	}

	public function testStaticCall() {
		$extension = new StaticExtensions();
		$this->assertTrue($extension->staticCall(self::class, 'returnTrue'));
		$this->assertNull($extension->staticCall(self::class, 'playSchlager'));
	}

	public function testStaticProperty() {
		$extension = new StaticExtensions();
		$this->assertTrue($extension->staticProperty(self::class, 'hammerfall'));
		$this->assertNull($extension->staticProperty(self::class, 'heleneFischer'));
	}
}