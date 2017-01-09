<?php
/**
 * Dynamic Numbers plugin for Craft CMS
 *
 * DynamicNumbers Service
 *
 *
 * @author    Trevor Davis
 * @copyright Copyright (c) 2017 Trevor Davis
 * @link      https://www.viget.com
 * @package   DynamicNumbers
 * @since     1.0.0
 */

namespace Craft;

class DynamicNumbersService extends BaseApplicationComponent
{
	protected $record;

	/**
	 * Constructor
	 * @param DynamicNumbersRecord $record
	 */
	public function __construct($record = null)
	{
		$this->record = $record;

		if (is_null($this->record)) {
			$this->record = DynamicNumbersRecord::model();
		}
	}

	/**
	 * Returns all DynamicNumbers
	 * @return array
	 */
	public function getAll()
	{
		$dynamicNumbers = craft()->db->createCommand()
			->select('id, label, key, value')
			->from('dynamicnumbers')
			->queryAll();

		return $dynamicNumbers;
	}

	/**
	 * Returns a single DynamicNumber based on id
	 * @param  int  $dynamicNumberId
	 * @return  DynamicNumbereModel $model
	 */
	public function getById($dynamicNumberId)
	{
		if ($record = $this->record->findByPk($dynamicNumberId)) {
			return DynamicNumbersModel::populateModel($record);
		}
	}

	/**
	 * Returns all DynamicNumbers with a matching key value
	 * @param  array  $keys
	 * @return array
	 */
	public function getByKeys($keys)
	{
		$dynamicNumbers = craft()->db->createCommand()
			->select('key, value')
			->from('dynamicnumbers')
			->where(['in', 'key', $keys])
			->queryAll();

		return $dynamicNumbers;
	}

	/**
	 * Create a new DynamicNumbers object and set the attributes
	 * @param  array  $attributes
	 * @return DynamicNumbersModel
	 */
	public function create($attributes = array())
	{
		$model = new DynamicNumbersModel();
		$model->setAttributes($attributes);
		return $model;
	}

	/**
	 * Save a new DynamicNumber or update existing
	 * @param  DynamicNumbersModel $model
	 * @return boolean
	 */
	public function save(DynamicNumbersModel &$model)
	{
		if ($id = $model->getAttribute('id')) {
			if (null === ($record = $this->record->findByPk($id))) {
				throw new Exception(Craft::t('Can\'t find Dynamic Number with ID "{id}"', array('id' => $id)));
			}
		} else {
			$record = new DynamicNumbersRecord();
		}

		$record->setAttributes($model->getAttributes());

		if ($record->validate()) {
			$record->save();

			// update id on model (for new records)
			$model->setAttribute('id', $record->getAttribute('id'));
			return true;
		} else {
			$model->addErrors($record->getErrors());
			return false;
		}
	}

	/**
	 * Delete DynamicNumber record by id
	 * @param  int $id
	 * @return boolean
	 */
	public function deleteById($id)
	{
		return $this->record->deleteByPk($id);
	}
}
