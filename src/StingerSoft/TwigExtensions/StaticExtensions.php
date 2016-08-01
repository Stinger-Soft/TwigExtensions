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
 * Some extensions to access static classes and properties
 */
class StaticExtensions extends \Twig_Extension {

	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see Twig_Extension::getFunctions()
	 */
	public function getFunctions() {
		return array(
			new \Twig_SimpleFunction('staticCall', array(
				$this,
				'staticCall' 
			)),
			new \Twig_SimpleFunction('staticProperty', array(
				$this,
				'staticProperty' 
			)) 
		);
	}

	/**
	 * Calls a static method on the given class
	 *
	 * @param string $class
	 *        	Full name of the class to execute a method on
	 * @param string $function
	 *        	The name of the static method
	 * @param array $args
	 *        	The arguments to pass to the method
	 * @return NULL|mixed
	 */
	public function staticCall($class, $function, $args = array()) {
		if(class_exists($class) && method_exists($class, $function))
			return call_user_func_array(array(
				$class,
				$function 
			), $args);
		return null;
	}

	/**
	 * Calls a static method on the given class
	 *
	 * @param string $class
	 *        	Full name of the class to execute a method on
	 * @param string $function
	 *        	The name of the static method
	 * @param array $args
	 *        	The arguments to pass to the method
	 * @return NULL|mixed
	 */
	public function staticProperty($class, $property, $args = array()) {
		if(!class_exists($class))
			return null;
		if(!property_exists($class, $property))
			return null;
		
		$vars = get_class_vars($class);
		return $vars[$property];
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see Twig_ExtensionInterface::getName()
	 */
	public function getName() {
		return 'stinger_soft_static_extensions';
	}
}