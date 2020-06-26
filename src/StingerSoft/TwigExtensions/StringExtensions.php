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

use StingerSoft\PhpCommons\String\Utils;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Twig extensions to format strings
 */
class StringExtensions extends AbstractExtension {

	/**
	 * {@inheritdoc}
	 */
	public function getFilters() {
		return [
			new TwigFilter('repeat', [$this, 'repeatFilter']),
			new TwigFilter('ucfirst', [$this, 'ucFirstFilter']),
			new TwigFilter('camelize', [$this, 'camelizeFilter']),
			new TwigFilter('highlight', [$this, 'highlightFilter']),
			new TwigFilter('initials', [$this, 'initialsFilter']),
		];
	}

	/**
	 * Repeats the text count times
	 *
	 * @param string $text
	 * @param int    $count
	 * @codeCoverageIgnore
	 * @return string
	 */
	public function repeatFilter($text, $count): string {
		return str_repeat($text, $count);
	}

	/**
	 * Capitalize the first character of the text
	 *
	 * @param string $text
	 * @codeCoverageIgnore
	 * @return string
	 */
	public function ucFirstFilter($text): string {
		return ucfirst($text);
	}

	/**
	 * Uppercase the first character of each word in a string
	 *
	 * @param string $text
	 *                                        The string to be camelized
	 * @param string $separator
	 *                                        Each character after this string will be uppercased
	 * @param bool   $capitalizeFirstCharacter
	 *                                        Whether to also capitalize the first character, default false
	 * @return string
	 * @codeCoverageIgnore
	 */
	public function camelizeFilter($text, $separator = '_', $capitalizeFirstCharacter = false): string {
		return Utils::camelize($text, $separator, $capitalizeFirstCharacter);
	}

	/**
	 * Highlights a given keyword in a string
	 *
	 * @param string $text
	 *            The string to search in
	 * @param string $keyword
	 *            The keyword to be highlighted
	 * @param string $preHighlight
	 *            This string will be attached before every match
	 * @param string $postHighlight
	 *            This string will be attached after every match
	 * @return string
	 * @codeCoverageIgnore
	 */
	public function highlightFilter($text, $keyword, $preHighlight = '<em>', $postHighlight = '</em>'): string {
		return Utils::highlight($text, $keyword, $preHighlight, $postHighlight);
	}

	/**
	 * Generates initials of the given string value.
	 *
	 * Every "first" character [a-Z] after a "stop" (whitespace, dot, dash etc.) character
	 * is appended to the initials.
	 *
	 * Initials cannot be generated for numbers.
	 *
	 * @param string|null $value      the string value to generate the initials for
	 * @param bool        $toUppercase
	 *                                whether the characters of the initials shall be changed to upper case.
	 * @return string|null the initials of the given value or null in case the given value was null.
	 */
	public static function initialsFilter(?string $value, bool $toUppercase = true): ?string {
		return Utils::initialize($value, $toUppercase);
	}
}
