<?php
class User extends CActiveRecord
{
	const DELETED_NO = 0; //正常未删除状态
	const DELETED_YES = 1; //删除状态
	const STATUS_DISABLE = 1; //禁用
	const STATUS_NORMAL = 0; //启用

	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

	public function tableName()
	{
		return '{{user}}';
	}

	public function behaviour()
	{
		return array(
			'UserBehavior' => array(
				'class' => 'application.behaviours.UserBehavior',
				),
			);
	}





	// public function add($name,$age)
	// {
	// 	$user= new User;
	// 	$user->name=$name;
	// 	$user->age=$age;
	// 	if ($user->save()) {
	// 		return $user->id;
	// 	} else {
	// 		return 0;

	// 	}
	// }

	// public function getuser($id)
	// {
	// 	$criteria=new CDbCriteria;
 //        $criteria->addColumnCondition(array('id'=>$id));
	// 	$users=User::model()->find($criteria);

	// 	return $users;
	// }
	/*public function getByPK($id)
	{
		$user = $this->findByPK($id);
		return $user;
	}


	public function getByAttr($name)
	{
		$user = $this->findByAttributes(array('name' => $name));
		return $user;
	}*/

	// find()
	// findAll();

	// public function getCont()
	// {
	// 	$cdbcr = new CDbCriteria;
	// }
}
?>