<?php 
class CateController extends Controller
{
	//跳转到添加分类页面
	public function actionAddcate()
	{
		$this->render('addcate');
	}
	//添加分类功能
	public function actionCategory()
	{
		
		if(Yii::app()->request->isPostRequest)
		{
			if(isset($_POST['category']))
			{
				$name = Yii::app()->request->getPost('category');
				$result=Cate::model()->addby($name);
				if($result<0)
				{
					$this->redirect('/cate/addcate');
				}
				$aa=$this->createUrl('cate/return', array('id' => $result));
				$this->redirect($aa);
			}
			
		}else
		{
			$this->redirect('/cate/addcate');
		}
		
	}
//跳转到总分类页面
	public function actionReturnall()
	{
		$cate=array();
		$cate=Cate::model()->getall();
		$this->render('showcate',compact('cate'));
	} 

	//跳转到详情页面
	public function actionReturn()
	{
		$cate=array();
		$id=Yii::app()->request->getQuery('id');
		if(!empty($id))
		{
			if($id>0)
			{
				$cate=Cate::model()->getcate($id);
				if(!empty($cate))
				{
					$this->render('category',compact('cate'));
				}
			}
			
		}else
		{
			$this->redirect('/cate/addcate');
		}
		
	}


	//删除分类操作
	public function actionDelete()
	{
		$id=Yii::app()->request->getQuery('id');
		if(!empty($id)){
			$end=Cate::model()->deletebyid($id);
			if($end!=0)
			{
				$this->redirect('/cate/returnall');
			}
		
		}else
		{
			$this->redirect('/cate/returnall');
		}
		
		
	}

	//修改操作
	public function actionChange()
	{
				$name = Yii::app()->request->getPost('names');
				$id= Yii::app()->request->getPost('ids');
				if(!empty($name)&&!empty($id))
				{
					$result=Cate::model()->change($name,$id);
					$this->redirect('/cate/return?id='.$result);
				}
				
	}
}
?>