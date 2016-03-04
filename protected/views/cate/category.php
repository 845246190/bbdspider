<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>最新</title>
</head>
<body>
<form  action = "/cate/change?" method="post" name="form">
<P>分类:<input type = "text" value="<?php if(!empty($cate->name)) echo $cate->name;?>" name = "names"/></p>
<input type = "hidden" value="<?php if(!empty($cate->id)) echo $cate->id;?>" name = "ids"/>
<input type="submit" value="修改">&nbsp;&nbsp;<a href='/cate/delete?id=<?php echo $cate->id;?>'>删除</a>&nbsp;&nbsp;<a href='/cate/returnall'>总分类</a>
</form>

</body>
</html>
