<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>最新</title>
</head>
<body>
<form  action = "/book/change" method="post" name="form">
<P>分类:<select name = "book[bookc]">
	<?php if(!empty($cate)):?>
	<?php  foreach($cate as $key=>$value):?>
	<option value='<?php if(!empty($value->id)) echo $value->id;?>'><?php if(!empty($value->name)) echo $value->name;?></option>
	<?php endforeach;?>
    <?php endif;?>
</select>
</p>
<P>书籍名称:<input type = "text" value="<?php if(!empty($book->name)) echo $book->name;?>" name = "book[bookn]"/></p>
<P>书籍作者:<input type = "text" value="<?php if(!empty($book->author))  echo $book->author;?>" name = "book[booka]"/></p>
<P>书籍简介:<input type = "text" value="<?php if(!empty($book->intro))  echo $book->intro;?>" name = "book[booki]"/></p>
	<input type = "hidden"  value="<?php if(!empty($book->id))  echo $book->id;?>" name = "book[bookid]"/>

<input type="submit" value="修改">&nbsp;&nbsp;&nbsp;&nbsp;<a href='/book/delete?id=<?php echo $book->id;?>'>删除</a>
&nbsp;&nbsp;&nbsp;&nbsp;<a href='/book/returnall'>全部书籍</a>
</form>

</body>
</html>