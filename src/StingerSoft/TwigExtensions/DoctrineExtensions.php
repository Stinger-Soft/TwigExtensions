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

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class DoctrineExtensions extends AbstractExtension {

	private $doctrineFunctions;

	/**
	 * Set the doctrine commons functions to be used by the twig extension.
	 *
	 * @param \StingerSoft\DoctrineCommons\Utils\DoctrineFunctionsInterface $doctrineFunctions
	 */
	public function setDoctrineFunctions(\StingerSoft\DoctrineCommons\Utils\DoctrineFunctionsInterface $doctrineFunctions = null): void {
		$this->doctrineFunctions = $doctrineFunctions;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getFilters() {
		return [
			new TwigFilter('entityIcon', [$this, 'entityIconFilter']),
			new TwigFilter('unproxify', [$this, 'unproxifyFilter']),
		];
	}

	/**
	 * Get the name / class of the icon to be displayed for the entity for a
	 * certain purpose.
	 *
	 * @param string|object $entity
	 *            the entity or class of entity to get an icon for
	 * @param string|null   $purpose
	 *            a purpose to get the entity for (if any) or <code>null</code> (default)
	 * @return string|null the icon name / class or <code>null</code>.
	 * @see \StingerSoft\DoctrineCommons\Utils\DoctrineFunctionsInterface::getEntityIcon
	 */
	public function entityIconFilter($entity, $purpose = null): ?string {
		if($this->hasDoctrineFunctions() && method_exists($this->doctrineFunctions, 'getEntityIcon')) {
			return $this->doctrineFunctions->getEntityIcon($entity, $purpose);
		}
		return null;
	}

	/**
	 * Transforms the given doctrine proxy object into a 'real' entity
	 *
	 * @param object $object
	 * @return object|null
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
	protected function hasDoctrineFunctions(): bool {
		if($this->doctrineFunctions !== null) {
			return true;
		}
		@trigger_error('Please install the stinger-soft/doctrine-commons dependency in order to use the doctrine twig extensions!', E_USER_WARNING);
		return false;
	}

}