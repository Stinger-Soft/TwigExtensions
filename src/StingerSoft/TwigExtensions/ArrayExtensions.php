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

/**
 * Twig filters to handle arrays
 */
class ArrayExtensions extends \Twig_Extension {

	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see Twig_Extension::getFilters()
	 */
	public function getFilters() {
		return array(
			new \Twig_SimpleFilter('unset', array(
				$this,
				'unsetFilter' 
			)) 
		);
	}

	/**
	 * Removes an element from the given array
	 *
	 * @param array $array        	
	 * @param array|string $keys        	
	 * @return array
	 */
	public function unsetFilter($array, $keys) {
		if(is_array($array)) {
			if(!is_array($keys)) {
				$keys = array(
					$keys 
				);
			}
			foreach($keys as $key) {
				if(array_key_exists($key, $array)) {
					unset($array[$key]);
				}
			}
		}
		return $array;
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see Twig_ExtensionInterface::getName()
	 */
	public function getName() {
		return 'stinger_soft_array_extensions';
	}
}