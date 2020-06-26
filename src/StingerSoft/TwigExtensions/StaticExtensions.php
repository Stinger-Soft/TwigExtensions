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
use Twig\TwigFunction;

/**
 * Some extensions to access static classes and properties
 */
class StaticExtensions extends AbstractExtension {

	/**
	 * {@inheritdoc}
	 */
	public function getFunctions() {
		return [
			new TwigFunction('staticCall', [$this, 'staticCall']),
			new TwigFunction('staticProperty', [$this, 'staticProperty',]),
		];
	}

	/**
	 * Calls a static method on the given class
	 *
	 * @param string $class
	 *            Full name of the class to execute a method on
	 * @param string $function
	 *            The name of the static method
	 * @param array  $args
	 *            The arguments to pass to the method
	 * @return null|mixed
	 */
	public function staticCall($class, $function, $args = []) {
		if(class_exists($class) && method_exists($class, $function)) {
			return call_user_func_array([
				$class,
				$function,
			], $args);
		}
		return null;
	}

	/**
	 * Gets a static property of  the given class
	 *
	 * @param string $class
	 *            Full name of the class to get a property value from
	 * @param string $property
	 *            The property of the static class
	 * @return null|mixed
	 */
	public function staticProperty($class, $property) {
		if(!class_exists($class)) {
			return null;
		}
		if(!property_exists($class, $property)) {
			return null;
		}

		$vars = get_class_vars($class);
		return $vars[$property];
	}

}