<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>最新</title>
</head>
<body>
<form  action = "/book/books" method="post" name="form">
<P>分类:<select name = "book[bookc]">
	<?php if(!empty($cate)):?>
	<?php  foreach($cate as $key=>$value):?>
	<option value='<?php echo $value->id;?>'><?php echo $value->name;?></option>
	<?php endforeach;?>
    <?php endif;?>
</select></p>
<P>书名:<input type = "text" name = "book[bookn]"/></p>
<P>作者:<input type = "text" name = "book[booka]"/></p>
<P>简介:<textarea  name = "book[booki]"></textarea></p>
<input type="submit" value="添加">&nbsp;&nbsp;&nbsp;&nbsp;<a href='/book/returnall'>全部书籍</a>
</form>
</body>
</html>