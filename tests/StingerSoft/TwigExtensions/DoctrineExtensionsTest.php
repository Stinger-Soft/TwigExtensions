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

use StingerSoft\DoctrineCommons\Utils\DoctrineFunctions;

class DoctrineExtensionsTest extends \PHPUnit_Framework_TestCase {

	public function testGetFilters() {
		$extension = new DoctrineExtensions();
		$this->assertCount(2, $extension->getFilters());
		$this->assertContainsOnlyInstancesOf('Twig_SimpleFilter', $extension->getFilters());
	}

	public function testGetName() {
		$extension = new DoctrineExtensions();
		$this->assertEquals('stinger_soft_doctrine_extensions', $extension->getName());
	}

	public function testGetEntityIconWODoctrineFunctions() {
		$extension = new DoctrineExtensions();
		// first lets test with a class, that does NOT have the defined method 'getEntityIcon'
		$icon = $extension->entityIconFilter(new \stdClass());
		$this->assertNull($icon);
		
		// now again, WITH a purpose given
		$icon = $extension->entityIconFilter(new \stdClass(), "purpose");
		$this->assertNull($icon);
		
		// now lets test with a class, that DOES have the defined method 'getEntityIcon'
		$icon = $extension->entityIconFilter($this->getClassMock());
		$this->assertNull($icon);
		
		// now again, WITH a purpose given
		$icon = $extension->entityIconFilter($this->getClassMock(), "purpose");
		$this->assertNull($icon);
	}

	public function testGetEntityIconWDoctrineFunctions() {
		$extension = new DoctrineExtensions();
		$extension->setDoctrineFunctions(new DoctrineFunctions($this->mockAbstractManagerRegistry(), $this->mockTranslatorInterface()));
		$icon = $extension->entityIconFilter(new \stdClass());
		$this->assertNull($icon);
		$icon = $extension->entityIconFilter(new \stdClass(), "purpose");
		$this->assertNull($icon);
		
		$icon = $extension->entityIconFilter($this->getClassMock());
		$this->assertNotNull($icon);
		$this->assertEquals("icon", $icon);
		
		$icon = $extension->entityIconFilter($this->getClassMock(), "purpose");
		$this->assertNotNull($icon);
		$this->assertEquals("purpose", $icon);
	}

	protected function getClassMock() {
		$mock = $this->getMockBuilder(\stdClass::class)->setMethods(array(
			'getEntityIcon' 
		))->getMock();
		$mock->method('getEntityIcon')->willReturnCallback(function ($purpose = null) {
			if($purpose != null) {
				return $purpose;
			}
			return "icon";
		});
		return $mock;
	}

	protected function mockAbstractManagerRegistry() {
		return $this->getMockBuilder('Doctrine\Common\Persistence\AbstractManagerRegistry')->disableOriginalConstructor()->getMock();
	}

	protected function mockTranslatorInterface() {
		return $this->getMockBuilder('Symfony\Component\Translation\TranslatorInterface')->disableOriginalConstructor()->getMock();
	}
}