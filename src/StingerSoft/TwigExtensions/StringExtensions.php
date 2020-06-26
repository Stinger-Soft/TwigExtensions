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

/**
 * Twig extensions to format strings
 */
class StringExtensions extends \Twig_Extension {

	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see Twig_Extension::getFilters()
	 */
	public function getFilters() {
		return array(
			new \Twig_SimpleFilter('repeat', array(
				$this,
				'repeatFilter' 
			)),
			new \Twig_SimpleFilter('ucfirst', array(
				$this,
				'ucFirstFilter' 
			)),
			new \Twig_SimpleFilter('camelize', array(
				$this,
				'camelizeFilter' 
			)),
			new \Twig_SimpleFilter('highlight', array(
				$this,
				'highlightFilter' 
			)) 
		);
	}

	/**
	 * Repeats the text count times
	 *
	 * @param string $text        	
	 * @param int $count
	 *        	@codeCoverageIgnore
	 */
	public function repeatFilter($text, $count) {
		return str_repeat($text, $count);
	}

	/**
	 * Capitilize the first character of the text
	 *
	 * @param string $text
	 *        	@codeCoverageIgnore
	 */
	public function ucFirstFilter($text) {
		return ucfirst($text);
	}

	/**
	 * Uppercase the first character of each word in a string
	 *
	 * @param string $text
	 *        	The string to be camelized
	 * @param string $separator
	 *        	Each character after this string will be uppercased
	 * @return string @codeCoverageIgnore
	 */
	public function camelizeFilter($text, $separator = '_', $capitalizeFirstCharacter = false) {
		return Utils::camelize($text, $separator, $capitalizeFirstCharacter);
	}

	/**
	 * Highlights a given keyword in a string
	 *
	 * @param string $text
	 *        	The string to search in
	 * @param string $keyword
	 *        	The keyword to be highlighted
	 * @param string $preHighlight
	 *        	This string will be attached before every match
	 * @param string $postHightlight
	 *        	This string will be attached after every match
	 * @return string @codeCoverageIgnore
	 */
	public function highlightFilter($text, $keyword, $preHighlight = '<em>', $postHightlight = '</em>') {
		return Utils::highlight($text, $keyword, $preHighlight, $postHightlight);
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see Twig_ExtensionInterface::getName()
	 */
	public function getName() {
		return 'stinger_soft_string_extensions';
	}
}
