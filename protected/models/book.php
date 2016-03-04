<?php 
class Book extends CActiveRecord
{
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	public function tableName()
	{
		return '{{book}}';
	}
	public function add($book)
	{
		$books= new Book;
		if(!empty($book))
		{
			$books->category=$book['bookc'];
			$books->name=$book['bookn'];
			$books->author=$book['booka'];
			$books->intro=$book['booki'];
			if ($books->save()) {
				return $books->id;
			} else {
				return 0;

		}

		}
		
	}

	public function getbook($id)
	{
		$books=array();
		$criteria=new CDbCriteria;
		if(!empty($id))
		{
			$criteria->addColumnCondition(array('id'=>$id,'state'=>0));
			$books=Book::model()->find($criteria);

		}
        
		return $books;
		
	}
	public function getall()
	{
		$books=array();
		$all=new CDbCriteria;
        $all->addColumnCondition(array('state'=>0));
        $all->order='id DESC';
		$books=Book::model()->findAll($all);
		//$users=$this->findAll();
		return $books;
	} 
	public function deletebyid($id)
	{
		if(!empty($id))
		{
			$books= $this->getbook($id);
			if(!empty($books))
			{
				$books->state=1;
				if ($books->save()) {
					return $books->id;
				} else {
					return 0;

				}
		
			}
		}
		
		
	}
	public function change($book)
	{
		if(!empty($book))
		{
			$books= $this->getbook($book['bookid']);
			if(!empty($books))
			{
				if(!empty($book['bookn'])) $books->name= $book['bookn'];
				if(!empty($book['bookc'])) $books->category=$book['bookc'];
				if(!empty($book['booka'])) $books->author= $book['booka'];
				if(!empty($book['booki'])) $books->intro=$book['booki'];
				if ($books->save())
				{
					return $books->id;
				} else {
					return 0;
				}

			}
			
		}
		
	}
}
?>