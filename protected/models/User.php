<?php
class User extends CActiveRecord
{
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	public function tableName()
	{
		return '{{user}}';
	}
	public function add($name,$age)
	{
		$user= new User;
		$user->name=$name;
		$user->age=$age;
		if ($user->save()) {
			return $user->id;
		} else {
			return 0;

		}
	}

	public function getuser($id)
	{
		$criteria=new CDbCriteria;
        $criteria->addColumnCondition(array('id'=>$id));
		$users=User::model()->find($criteria);

		return $users;
	}
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