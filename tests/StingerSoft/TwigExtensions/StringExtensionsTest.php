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

	public function testGetFunctions(): void {
		$extension = new StringExtensions();
		$this->assertCount(5, $extension->getFilters());
		$this->assertContainsOnlyInstancesOf('Twig\TwigFilter', $extension->getFilters());
	}

}