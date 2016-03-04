<?php
class UserController extends UserController
{
	public function action()
	{
		$id = Yii::app()->request->getQuery('id');
		$name = Yii::app()->request->getPost('name');
	}
}