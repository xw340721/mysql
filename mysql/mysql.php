<?php 
header("Content-Type:text/html;charset=utf8");
	$link = mysql_connect('localhost','root','xw340721');
	mysql_select_db('xw',$link);
	// $sql = "CREATE TABLE if not exists shoppings(
	// 	id int not null auto_increment,
	// 	name varchar(30) not null default '',
	// 	price double not null default '0.00',
	// 	desn text ,
	// 	primary key(id),
	// 	index name(name,price)
	// )";
	// $result = mysql_query($sql);
	// if(!$result){
	// 	echo 'REEOR:'.mysql_errno().'内容:'.mysql_error();
	// }else{
	// 	echo '数据连接成功<br>';
	// }
	// $sql = "alter table shoppings add num int  unsigned not null  after price" ;

	// $sql = "insert into shoppings(name,price,num,desn) values('{$_GET["name"]}','{$_GET["price"]}','{$_GET["num"]}','{$_GET['desn']}')";
	$sql = "update shoppings set name='{$_GET["name"]}' where id >7";
	echo $sql.'<br>';
	$result = mysql_query($sql);
	if(!$result){
		echo 'REEOR:'.mysql_errno().'内容:'.mysql_error();
	}else{
		echo '数据连接成功';
	}
	echo 'id:'.mysql_insert_id().'<br>';
	echo "影响的行数".mysql_affected_rows().'<br>';



  ?>