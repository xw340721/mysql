<?php 
	error_reporting(E_ALL&~E_NOTICE&&E_DEPRECATED);
	header("Content-Type:text/html;charset=utf8");
	$link = mysql_connect('localhost','root','xw340721') or die('connect error');
	mysql_select_db('xw',$link);
function table($path){	
	//第一次发出请求
	$sql = "select *from {$path} ";	
	
	//设置每页的数
	$num = 10;
	
	//第一次查询结果
	$result = mysql_query($sql);
	
	//统计页数
	$total = mysql_num_rows($result);

	//每次请求的URL
	$url = 'tables.php';

	//当前页
	$presentpage = isset($_GET['page']) ? $_GET['page']  : 1 ;

	//偏移量
	$offset = ($presentpage-1)*$num;
	
	//总共的列数
	$cols = mysql_num_fields($result);
	
	//总页数
	$pagetotal = ceil($total/$num);
	
	//第二次请求计算
	$sql = "select *from {$path} limit {$offset},{$num}";
	
	//第二次请求结果
	$result = mysql_query($sql);
	
	//页数开始页
	$start=$offset+1;  

	//当前页截止的页数
	$end=($presentpage==$pagetotal)? $total : ($presentpage*$num);  //结束记录

	//下一页
	$next=($presentpage==$pagetotal)? 0 : ($presentpage+1);

	//上一页
	$prev=($presentpage==1) ? 0 : ($presentpage - 1);

	//表格输出 
	echo '<table width="800" border="1" align="center">';
	echo '<caption>'.$path.'</caption>';
	echo '<tr>';
	for($i = 0;$i<$cols;$i++){
		echo '<th>'.mysql_field_name($result, $i).'</th>';
	}
	echo '</tr>';
	while($data = mysql_fetch_assoc($result)){
		echo '<tr>';
		foreach ($data as $value) {
			echo '<td>'.$value.'</td>';
		}
		echo '</tr>';
	}
	echo "<tr ><td colspan={$cols} align='right'>";
	echo "共<b>{$total}</b>条记录,本页显示<b>{$start}-{$end}&nbsp;&nbsp;{$presentpage}/{$pagetotal}</b>";
	
	//判断是否是第一页
	if($presentpage ==1){
	echo "&nbsp;&nbsp;首页&nbsp;&nbsp;";	
	}else{
	echo "&nbsp;&nbsp;<a href='{$url}?page=1'>首页</a>&nbsp;&nbsp;";
	}
	
	//判断有没有$prev 存在 因为$prev = ($presentpage = 1) ?  0 : $presentpage-1; 
	if($prev){
	echo "&nbsp;&nbsp;<a href='{$url}?page={$prev}'>上一页</a>&nbsp;&nbsp;";	
	}else{
	echo "&nbsp;&nbsp;上一页&nbsp;&nbsp;";	
	}
	
	//判断有没有$next 因为$next = ($presentpage = $pagetotal) 0 ? $presetnpage+1;
	if($next){
	echo "&nbsp;&nbsp<a href='{$url}?page={$next}'>下一页</a>&nbsp;&nbsp;";	
	}else{
	echo "&nbsp;&nbsp下一页&nbsp;&nbsp;";	
	}
	
	//判断是否是最后一个资源
	if($presentpage == $pagetotal){
	echo "&nbsp;&nbsp;尾页&nbsp;&nbsp;";	
	}else{
	echo "$nbsp;&nbsp;<a href= '{$url}?page={$pagetotal}'>尾页</a>&nbsp;&nbsp";
	}
	echo '</td></tr>';
	echo '</table>';

	//关闭资源
	mysql_free_result($result);
}
	table('shoppings');
	mysql_close($link);
