<?php
/**
 * Dynamic Numbers plugin for Craft CMS
 *
 * DynamicNumbers Variable
 *
 *
 * @author    Trevor Davis
 * @copyright Copyright (c) 2017 Trevor Davis
 * @link      https://www.viget.com
 * @package   DynamicNumbers
 * @since     1.0.0
 */

namespace Craft;

class DynamicNumbersVariable
{
	/**
	 * Returns all DynamicNumbers
	 * @return array
	 */
	public function getAll()
	{
		return craft()->dynamicNumbers->getAll();
	}

	/**
	 * Returns a single DynamicNumber based on id
	 * @param  int  $dynamicNumberId
	 * @return  DynamicNumbereModel $model
	 */
	public function getById($dynamicNumberId)
	{
		return craft()->dynamicNumbers->getById($dynamicNumberId);
	}
}
