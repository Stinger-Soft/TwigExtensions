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

class StaticExtensionsTest extends TestCase {

	public static $hammerfall = true;

	public static function returnTrue(): bool {
		return true;
	}

	public function testGetFunctions(): void {
		$extension = new StaticExtensions();
		$this->assertCount(2, $extension->getFunctions());
		$this->assertContainsOnlyInstancesOf('Twig\TwigFunction', $extension->getFunctions());
	}

	public function testStaticCall(): void {
		$extension = new StaticExtensions();
		$this->assertTrue($extension->staticCall(self::class, 'returnTrue'));
		$this->assertNull($extension->staticCall(self::class, 'playSchlager'));
	}

	public function testStaticProperty(): void {
		$extension = new StaticExtensions();
		$this->assertTrue($extension->staticProperty(self::class, 'hammerfall'));
		$this->assertNull($extension->staticProperty(self::class, 'heleneFischer'));
	}
}