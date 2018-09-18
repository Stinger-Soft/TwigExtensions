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
use Symfony\Component\Translation\TranslatorInterface;

class PrettyPrintExtensionsTest extends TestCase {

	protected function mockTranslator() {
		$translator = $this->getMockBuilder(TranslatorInterface::class)->disableOriginalConstructor()->setMethods(array(
			'transChoice' 
		))->getMockForAbstractClass();
		$translator->method('transChoice')->willReturnArgument(0);
		return $translator;
	}

	public function testGetFunctions() {
		$extension = new PrettyPrintExtensions($this->mockTranslator());
		$this->assertCount(2, $extension->getFilters());
		$this->assertContainsOnlyInstancesOf('Twig_SimpleFilter', $extension->getFilters());
	}

	public function testGetName() {
		$extension = new PrettyPrintExtensions($this->mockTranslator());
		$this->assertEquals('stinger_soft_pretty_print_extensions', $extension->getName());
	}
}