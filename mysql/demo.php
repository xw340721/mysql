<?php
	error_reporting(E_ALL&~E_NOTICE&&E_DEPRECATED);
	header("Content-Type:text/html;charset=utf8");
	//step 1
	$link=mysql_connect("localhost", "root", "xw340721") or die("connect error!");
	//step 2
	mysql_select_db("xw") or die("select db error!");


function table($tabname) {
	//execute SQL
	$sql="select * from {$tabname}";


	$num=10;   //每页显示的条数


	//result
	$result=mysql_query($sql);

	$total=mysql_num_rows($result);  //总记录数


	$url="demo.php";  //每次请求的URL

	$cpage=isset($_GET["page"]) ? $_GET["page"] : 1;// 当前页

	$pagenum=ceil($total/$num);  //总页数

	$offset=($cpage-1)*$num;   //开始取数据的位置

	$sql="select * from {$tabname} limit {$offset}, {$num}";
	
	$result=mysql_query($sql);

	$start=$offset+1;   //开始记录

	$end=($cpage==$pagenum)? $total : ($cpage*$num);  //结束记录


	$next=($cpage==$pagenum)? 0 : ($cpage+1);
	$prev=($cpage==1) ? 0 : ($cpage - 1);
	


	$cols=mysql_num_fields($result);
	echo '<table align="center" width="800" border="1">';
	echo '<caption><h1>'.$tabname.'</h1></caption>';
	echo '<tr>';	
	for($i=0; $i<$cols; $i++){

		echo '<th>'.mysql_field_name($result, $i).'</th>';
	}
	echo '</tr>';
	while($row=mysql_fetch_assoc($result)){
		echo '<tr>';
		foreach($row as $col){
			echo '<td>'.$col.'</td>';
		}
		echo '</tr>';
	}

	echo '<tr><td colspan="'.$cols.'" align="right">';
	echo "共<b>{$total}</b>条记录, 本页显示<b>{$start}-{$end}</b> &nbsp;&nbsp;{$cpage}/{$pagenum}";
	if($cpage==1)
		echo "&nbsp;&nbsp;首页&nbsp;&nbsp;";
	else
		echo "&nbsp;&nbsp;<a href='{$url}?page=1'>首页</a>&nbsp;&nbsp;";

	if($prev)
		echo "&nbsp;&nbsp;<a href='{$url}?page={$prev}'>上一页</a>&nbsp;&nbsp;";
	else
		echo "&nbsp;&nbsp;上一页&nbsp;&nbsp;";

	if($next)
		echo "&nbsp;&nbsp;<a href='{$url}?page={$next}'>下一页</a>&nbsp;&nbsp;";
	else
		echo "&nbsp;&nbsp;下一页&nbsp;&nbsp;";

	if($cpage==$pagenum)
		echo "&nbsp;&nbsp;尾页&nbsp;&nbsp;";
	else
		echo "&nbsp;&nbsp;<a href='{$url}?page={$pagenum}'>尾页</a>&nbsp;&nbsp;";

	echo '<td></tr>';


	echo '</table>';


	//close
	mysql_free_result($result);
}

table('shoppings');

	mysql_close();	
