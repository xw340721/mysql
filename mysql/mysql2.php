<?php 
	error_reporting(E_ALL&~E_NOTICE&&E_DEPRECATED);
	header("Content-Type:text/html;charset=utf8");
	$link = mysql_connect('localhost','root','xw340721') or die('connect error');
	mysql_select_db('xw',$link);
	$sql = "select id,name ,price,num,desn from shoppings";
	$result = mysql_query($sql);
	echo '<table width="800" border="1" align="center">';
	echo '<caption>清单</caption>';
	$rows = mysql_num_rows($result);//获取行数
	$cols = mysql_num_fields($result);//获取列数
	echo '<tr>';
	for($i = 0;$i<$cols;$i++){
		echo '<th>'.mysql_field_name($result, $i).'</th>';
	}
	echo '</tr>';
	// while(list($id,$name,$price,$num,$desn) = mysql_fetch_array($result)){
	// 	echo '<tr>';
	// 	echo '<td>'.$id.'</td>';
	// 	echo '<td>'.$name.'</td>';
	// 	echo '<td>'.$price.'</td>';
	// 	echo '<td>'.$num.'</td>';
	// 	echo '<td>'.$desn.'</td>';
	// 	echo "<tr>";	
	// }
	while($data = mysql_fetch_assoc($result)){
		echo '<tr>';
		foreach ($data as $value) {
			echo '<td>'.$value.'</td>';
		}
		echo '</tr>';
	}
	echo '</table>';

	mysql_free_result($result);
	mysql_close($link);
