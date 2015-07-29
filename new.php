<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/28
 * Time: 11:33
 */
error_reporting(E_ALL&~E_DEPRECATED);
header("Content-Type:text/html;charset=utf-8");
include 'page.class.php';
$link =mysql_connect('localhost','root','xw340721') or die('连接失败');
mysql_select_db('xw',$link) or die('每有改数据库');

$sql='select *from shopping';
$result = mysql_query($sql);
$total = mysql_num_rows($result);
$num = 10;
$page = new Page($total,$num);
$sql = "select *from shopping {$page->limit}";
$result = mysql_query($sql);
$cols = mysql_num_fields($result);
echo '<table width="1200" align="center" border="1">';
echo '<caption><h2>shopping</h2></caption>';
echo '<tr>';
for($i = 0;$i<$cols;$i++){
    echo '<td>'.mysql_field_name($result,$i).'</td>';
}
echo '</tr>';
while($data = mysql_fetch_assoc($result)){
    echo '<tr>';
    foreach($data as $value){
        echo "<td>{$value}</td>";
    }
    echo '</tr>';
}
echo '<tr><td colspan="5" align="right">'.$page->fpage().'</td></tr>';
echo '</table>';
mysql_close($link);
?>
</body>
<script type="text/javascript">
window.onload= function () {
   var btn = document.getElementById('btn');
    btn.addEventListener('click', function () {
        var num = document.getElementById('num').value;
        var local='http://localhost:59146/www/new.php?page='+num;
        window.location.replace(local)
    },false)
}
</script>
</html>