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
			)),
			new \Twig_SimpleFilter('unproxify', array(
				$this,
				'unproxifyFilter' 
			)) 
		);
	}

	/**
	 * Get the name / class of the icon to be displayed for the entity for a
	 * certain purpose.
	 *
	 * @param string|object $entity
	 *        	the entity or class of entity to get an icon for
	 * @param string|null $purpose
	 *        	a purpose to get the entity for (if any) or <code>null</code> (default)
	 * @return string|null the icon name / class or <code>null</code>.
	 * @see \StingerSoft\DoctrineCommons\Utils\DoctrineFunctionsInterface::getEntityIcon
	 */
	public function entityIconFilter($entity, $purpose = null) {
		if($this->hasDoctrineFunctions() && method_exists($this->doctrineFunctions, 'getEntityIcon')) {
			return $this->doctrineFunctions->getEntityIcon($entity, $purpose);
		}
		return null;
	}

	/**
	 * Transforms the given doctrine proxy object into a 'real' entity
	 *
	 * @param object $object        	
	 * @return object|NULL
	 */
	public function unproxifyFilter($object) {
		if($this->hasDoctrineFunctions() && method_exists($this->doctrineFunctions, 'unproxifyFilter')) {
			return $this->doctrineFunctions->unproxifyFilter($object);
		}
		return $object;
	}

	/**
	 * Checks whether the doctrine functions are available and triggers a warning if not.
	 *
	 * @return boolean <code>true</code> in case the doctrine functions are available, <code>false</code> otherwise.
	 */
	protected function hasDoctrineFunctions() {
		if($this->doctrineFunctions != null) {
			return true;
		} else {
			@trigger_error('Please install the stinger-soft/doctrine-commons dependency in order to use the doctrine twig extensions!', E_USER_WARNING);
			return false;
		}
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