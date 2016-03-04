<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>最新</title>
</head>
<body>
<table border="1">
  <tr>
    <th>分类</th>
    <th>分类id</th>
    <th>操作</th>
  </tr>
  <?php if(!empty($cate)):?>
 <?php  foreach($cate as $key=>$value):?>
<tr>
    <td><?php  echo $value->name;?></td>
    <td><?php  echo $value->id;?></td>
    <td>
    <a href='/cate/return?id=<?php echo  $value->id; ?>'>详情页面</a>  
    &nbsp;&nbsp;<a href='/cate/delete?id=<?php echo $value->id;?>'>删除</a>
    </td>
  </tr>
<?php endforeach;?>
<?php endif;?>
</table>
	&nbsp;&nbsp;&nbsp;&nbsp; <a href='/cate/addcate'>添加分类</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href='/book/addbook'>添加书籍</a>
  &nbsp;&nbsp;&nbsp;&nbsp; <a href='/book/returnall'>查看全部书籍</a>
</body>
</html>