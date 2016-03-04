<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>最新</title>
</head>
<body>
<table border="1">
  <tr>
    <th>书籍名称</th>
    <th>书籍类别</th>
    <th>书籍id</th>
    <th>书籍作者</th>
    <th>书籍简介</th>
    <th>操作</th>
  </tr>
  <?php if(!empty($book)):?>
 <?php foreach($book as $key=>$value):?>
<tr>
    <td><?php echo $value->name;?></td>
    <td><?php echo $value->category;?></td>
    <td><?php echo $value->id;?></td>
    <td><?php echo $value->author;?></td>
    <td><?php echo $value->intro;?></td>
    <td> <a href='/book/return?id=<?php echo  $value->id;?>'>详情页面</a>&nbsp;&nbsp;<a href='/book/delete?id=<?php echo $value->id;?>'>删除</a></td>
  </tr>
<?php endforeach;?>
<?php endif;?>
</table>
&nbsp;&nbsp;&nbsp;&nbsp; <a href='/book/addbook'>添加书籍</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='/cate/returnall'>返回总分类页面</a>
</body>
</html>