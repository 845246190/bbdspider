<?php 
class BookController extends Controller
{
	//跳转到添加书籍的页面
	public function actionAddbook()
	{
		$cate=array();
		$cate=Cate::model()->getall();
		$this->render('bookadd',compact('cate'));
	}
	//添加书籍功能
	public function actionBooks()
	{

		if(Yii::app()->request->isPostRequest)
		{
			if(isset($_POST['book']))
			{
				$book = Yii::app()->request->getPost('book');
				$result=Book::model()->add($book);
				$this->redirect('/book/return?id='.$result);
			}else
			{
				$this->redirect('/book/addbook');
			}
			
		}else
		{
			$this->redirect('/book/addbook');
		}
		
	}
	//跳转到总书籍页面
	public function actionReturnall()
	{

		$book=array();
		$book=Book::model()->getall();
		$this->render('showbook',compact('book'));
	} 

	//跳转到书籍详情页面
	public function actionReturn()
	{
		$book=array();
		$cate=array();
		$id=Yii::app()->request->getQuery('id');
		if($id>0)
		{
			$cate=Cate::model()->getall();
			$book=Book::model()->getbook($id);
			if(!empty($cate)&&!empty($book)){
				$this->render('book',compact('book','cate'));
			}
			
		}

		
	}


	//删除分类操作
	public function actionDelete()
	{
		$id=Yii::app()->request->getQuery('id');
		if(!empty($id))
		{
			$end=Book::model()->deletebyid($id);
			if($end!=0)
			{
				$this->redirect('/book/returnall');
			}
		}
		$this->redirect('/book/returnall');
		
		
	}

	//修改操作
	public function actionChange()
	{
				$book = Yii::app()->request->getPost('book');
				if(!empty($book)&&!empty($book['bookid']))
				{
					$result=Book::model()->change($book);
					$this->redirect('/book/return?id='.$result);
				}
				
	}
}
?>