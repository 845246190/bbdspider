<?php
class UserController extends Controller
{
	public function action()
	{
		$id = Yii::app()->request->getQuery('id');
		$name = Yii::app()->request->getPost('name');
	}
}