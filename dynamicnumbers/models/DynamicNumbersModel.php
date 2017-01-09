<?php
/**
 * Dynamic Numbers plugin for Craft CMS
 *
 * DynamicNumbers Model
 *
 *
 * @author    Trevor Davis
 * @copyright Copyright (c) 2017 Trevor Davis
 * @link      https://www.viget.com
 * @package   DynamicNumbers
 * @since     1.0.0
 */

namespace Craft;

class DynamicNumbersModel extends BaseModel
{
	/**
	 * Defines this model's attributes.
	 *
	 * @return array
	 */
	protected function defineAttributes()
	{
		return array_merge(parent::defineAttributes(), array(
			'id' => AttributeType::Number,
			'label' => array(AttributeType::String, 'default' => '', 'required' => true),
			'key' => array(AttributeType::Handle, 'default' => '', 'required' => true),
			'value' => array(AttributeType::String, 'default' => '', 'required' => true),
		));
	}

}
