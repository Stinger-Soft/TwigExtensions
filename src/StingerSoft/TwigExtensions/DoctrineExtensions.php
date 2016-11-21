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

class DoctrineExtensions extends \Twig_Extension {

	private $doctrineFunctions;

	/**
	 * Set the doctrine commons functions to be used by the twig extension.
	 *
	 * @param \StingerSoft\DoctrineCommons\Utils\DoctrineFunctionsInterface $doctrineFunctions        	
	 */
	public function setDoctrineFunctions(\StingerSoft\DoctrineCommons\Utils\DoctrineFunctionsInterface $doctrineFunctions = null) {
		$this->doctrineFunctions = $doctrineFunctions;
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see Twig_Extension::getFilters()
	 */
	public function getFilters() {
		return array(
			new \Twig_SimpleFilter('entityIcon', array(
				$this,
				'entityIconFilter' 
			)) 
		);
	}

	/**
	 * @param string|object $entity
	 * @param string|null $purpose
	 * @return string|null
	 * @see \StingerSoft\DoctrineCommons\Utils\DoctrineFunctionsInterface::getEntityIcon
	 */
	public function entityIconFilter($entity, $purpose = null) {
		if($this->doctrineFunctions != null && method_exists($this->doctrineFunctions, 'getEntityIcon')) {
			return $this->doctrineFunctions->getEntityIcon($entity, $purpose);
		}
		return null;
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see Twig_ExtensionInterface::getName()
	 */
	public function getName() {
		return 'stinger_soft_doctrine_extensions';
	}
}