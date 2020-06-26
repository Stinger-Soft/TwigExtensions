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

/**
 * Twig filters to handle arrays
 */
class ArrayExtensions extends AbstractExtension {

	/**
	 * {@inheritdoc}
	 */
	public function getFilters() {
		return [
			new TwigFilter('unset', [$this, 'unsetFilter']),
		];
	}

	/**
	 * Removes an element from the given array
	 *
	 * @param array        $array
	 * @param array|string $keys
	 * @return array
	 */
	public function unsetFilter($array, $keys): array {
		if(is_array($array)) {
			if(!is_array($keys)) {
				$keys = [
					$keys,
				];
			}
			foreach($keys as $key) {
				if(array_key_exists($key, $array)) {
					unset($array[$key]);
				}
			}
		}
		return $array;
	}

}