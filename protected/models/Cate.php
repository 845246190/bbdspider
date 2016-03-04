<?php
class Cate extends CActiveRecord
{
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	public function tableName()
	{
		return '{{category}}';
	}
	public function addby($name)
	{
		$cates= new Cate;
		if(!empty($name))
		{
			$names=$this->getbyname($name);
			if(!empty($names))
			{
				return -1;
			}
			$cates->name=$name;
			if ($cates->save()) 
			{
				return $cates->id;
			} else {
				return 0;

			}
			
			
		}
		
	}
	public function getbyname($name)
	{
		$cates=array();
		$criteria=new CDbCriteria;
		if(!empty($name))
		{
			$criteria->addColumnCondition(array('name'=>$name,'state'=>0));
			$cates=Cate::model()->find($criteria);
			
			
		}
        
		return $cates;
	}

	public function getcate($id)
	{
		$cates=array();
		$criteria=new CDbCriteria;
		if(!empty($id))
		{
			$criteria->addColumnCondition(array('id'=>$id,'state'=>0));
			$cates=Cate::model()->find($criteria);	

		}
        
		return $cates;
		
	}
	public function getall()
	{
		$cates=array();
		$all=new CDbCriteria;
        $all->addColumnCondition(array('state'=>0));
        $all->order='id DESC';
		$cates=Cate::model()->findAll($all);
		//$users=$this->findAll();
		return $cates;
	} 
	public function deletebyid($id)
	{
		if(!empty($id))
		{
			$cates= $this->getcate($id);
			if(!empty($cates))
			{
				$cates->state=1;
				if ($cates->save()) {
					return $cates->id;
				} else {
					return 0;

				}
		
			}	
		}
		
	}
	public function change($name,$id)
	{
		if(!empty($name)&&!empty($id))
		{
			$cates= $this->getcate($id);
			if(!empty($cates)){
				$cates->name= $name;
				if ($cates->save()) {
					return $cates->id;
				} else {
					return 0;

				}

		}
	}
		
}
}
?>