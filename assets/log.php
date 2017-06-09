<?php
/*главная задача этого скрипта -  обновить файл results.json данными с рабочей базы*/
/*тут я закомментировал все отладочные выводы echo, чтоб сработал header ('Location: work.html')*/

$data = array();

/*
echo ' Введен логин:'.$_POST['log'];
echo '<br/>';
echo ' Введен пароль: '.$_POST['pas'];
echo '<br/>';*/

$link = mysqli_connect("db20.freehost.com.ua", "grand_test", "Test1", "grand_test");

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
/*
echo "Соединение с MySQL установлено!" . PHP_EOL;
echo '<br/>';
echo "Информация о сервере: " . mysqli_get_host_info($link) . PHP_EOL;
echo '<br/>';*/


$result = mysqli_query($link,"SELECT * FROM users") or die("Ошибка " . mysqli_error($link)); 
/*if($result){echo "Выполнение запроса прошло успешно";}
*/
while($row = mysqli_fetch_assoc($result)){$data[] = $row;}

$data_json=json_encode($data);
/*echo '<br/>';
  			echo 'data_json: ';echo $data_json;
*/
$fp = fopen('results.json', 'w');
fwrite($fp, $data_json);
fclose($fp);
/*if($fp){
	echo '<br/>';
   echo "Обновление results.json прошло успешно";
}
echo '<br/>';echo $_POST['log'];*/
mysqli_close($link);
header ('Location: work.html');
?>
