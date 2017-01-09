<?php
/**
 * Dynamic Numbers plugin for Craft CMS
 *
 * Dynamic Numbers Twig Extension
 *
 *
 * @author    Trevor Davis
 * @copyright Copyright (c) 2017 Trevor Davis
 * @link      https://www.viget.com
 * @package   DynamicNumbers
 * @since     1.0.0
 */

namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class DynamicNumbersTwigExtension extends \Twig_Extension
{
	/**
	 * Returns the name of the extension.
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'DynamicNumbers';
	}

	/**
	 * Returns an array of Twig filters, used in Twig templates via:
	 *
	 *      {{ 'something' | dynamicNumbers }}
	 *
	 * @return array
	 */
	public function getFilters()
	{
		return array(
			'dynamicNumbers' => new \Twig_Filter_Method($this, 'replaceDynamicNumbers'),
		);
	}

	/**
	 * Returns an array of Twig functions, used in Twig templates via:
	 *
	 *      {% set this = dynamicNumbers('something') %}
	 *
	 * @return array
	 */
	public function getFunctions()
	{
		return array(
			'dynamicNumbers' => new \Twig_Function_Method($this, 'replaceDynamicNumbers'),
		);
	}

	/**
	 * Replaces instances of DynamicNumber keys with their coresponding values
	 *
	  * @return string
	 */
	public function replaceDynamicNumbers($text = null)
	{
		$pattern = '/\[#\w*\]/';
		$hasDynamicNumbers = preg_match_all($pattern, $text, $matches);

		// No matches, return the original text
		if (!$hasDynamicNumbers) return $text;

		$matches = array_map(function($item) {
			return trim($item, '#[]');
		}, $matches[0]);

		// Get our DynamicNumbers based on the matched keys and replace their values in the text
		$dynamicNumbers = craft()->dynamicNumbers->getByKeys($matches);

		foreach ($dynamicNumbers as &$dynamicNumber) {
			$text = str_replace('[#' . $dynamicNumber['key'] . ']', $dynamicNumber['value'], $text);
		}

		return $text;
	}
}
