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
use Symfony\Contracts\Translation\TranslatorInterface;

class PrettyPrintExtensionsTest extends TestCase {

	protected function mockTranslator(): \PHPUnit\Framework\MockObject\MockObject {
		$translator = $this->getMockBuilder(TranslatorInterface::class)->disableOriginalConstructor()->setMethods([
			'trans',
		])->getMockForAbstractClass();
		$translator->method('trans')->willReturnArgument(0);
		return $translator;
	}

	public function testGetFunctions(): void {
		$extension = new PrettyPrintExtensions($this->mockTranslator());
		$this->assertCount(2, $extension->getFilters());
		$this->assertContainsOnlyInstancesOf('Twig\TwigFilter', $extension->getFilters());
	}

}
