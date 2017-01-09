<?php
/**
 * Dynamic Numbers plugin for Craft CMS
 *
 * DynamicNumbers Record
 *
 *
 * @author    Trevor Davis
 * @copyright Copyright (c) 2017 Trevor Davis
 * @link      https://www.viget.com
 * @package   DynamicNumbers
 * @since     1.0.0
 */

namespace Craft;

class DynamicNumbersRecord extends BaseRecord
{
	/**
	 * Returns the name of the database table the model is associated with
	 *
	 * @return string
	 */
	public function getTableName()
	{
		return 'dynamicnumbers';
	}

	/**
	 * Returns an array of attributes which map back to columns in the database table.
	 *
	 * @access protected
	 * @return array
	 */
	protected function defineAttributes()
	{
		return array(
			'label' => array(AttributeType::String, 'default' => '', 'required' => true),
			'key' => array(AttributeType::Handle, 'default' => '', 'required' => true),
			'value' => array(AttributeType::String, 'default' => '', 'required' => true),
		);
	}

	/**
	 * Returns an array of indexes on the database table
	 *
	 * @return array
	 */
	public function defineIndexes()
	{
		return array(
			array('columns' => array('key'), 'unique' => true),
		);
	}
}
