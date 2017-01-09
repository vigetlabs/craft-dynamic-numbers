<?php
/**
 * Dynamic Numbers plugin for Craft CMS
 *
 * DynamicNumbers Controller
 *
 *
 * @author    Trevor Davis
 * @copyright Copyright (c) 2017 Trevor Davis
 * @link      https://www.viget.com
 * @package   DynamicNumbers
 * @since     1.0.0
 */

namespace Craft;

class DynamicNumbersController extends BaseController
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->requirePostRequest();
	}

	/**
	 * This action is called when a Dynamic Number is saved
	 */
	public function actionSave()
	{
		// Is this an existing entry or a new entry?
		if ($id = craft()->request->getPost('dynamicNumberId')) {
			$model = craft()->dynamicNumbers->getById($id);
		} else {
			$model = craft()->dynamicNumbers->create();
		}

		// Get the submitted data
		$data = craft()->request->getPost('dynamicNumber');
		$model->label = $data['label'];
		$model->key = $data['key'];
		$model->value = $data['value'];

		// Did we pass validation?
		if($model->validate() && craft()->dynamicNumbers->save($model)) {
			craft()->userSession->setNotice(Craft::t('Dynamic Number saved.'));

			return $this->redirectToPostedUrl();
		} else {
			craft()->userSession->setError(Craft::t('There was a problem with your submission, please check the form and try again!'));
			craft()->urlManager->setRouteVariables(array('dynamicNumber' => $model));
		}
	}


	/**
	 * This action is called when a Dynamic Number is deleted
	 */
	public function actionDelete()
	{
		$this->requireAjaxRequest();

		$id = craft()->request->getRequiredPost('id');
		$result = craft()->dynamicNumbers->deleteById($id);

		$this->returnJson(array('success' => $result));
	}
}
