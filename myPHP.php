<?php

if($_POST['go'] == 'Отправить'){
	if ($_POST['kontract'] == ''){
		print('Вы не ознакомились с контрактом. Пожалуйста, ознакомьтесь с ним!');
		exit();
	}
	
    foreach($_POST as $key => $val){
        if(empty($val)){
			print('Вы что-то не ввели. Пожалуйста, дополните свою анкету! ');
			exit();
        }
    }
    
	$name = $_POST['name'];
	$email = $_POST['email'];
	$date = $_POST['date'];
	$sex = $_POST['sex'];
	$limb = $_POST['limb'];
	$ability = $_POST['ability'];
    $osebe = $_POST['osebe'];  
    
    extract($_POST);
    
    // Проверяем email на соответствие шаблону
    if(!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)){
		print('email неверно написан');
		exit();
    }
	
	// Подключаемся к базе данных
	$login = 'u20294';
	$password = '5205554';
	$data_base = new PDO('mysql:host=localhost;dbname=u20294', $login, $password);

	try {
		$query = $data_base->prepare("INSERT INTO profi (name, email, date, sex, limb, ability, osebe) VALUES (:name, :email, :date, :sex, :limb, :ability, :osebe)");
		$query->bindParam(':name', $name);
		$query->bindParam(':email', $email);
		$query->bindParam(':date', $date);
		$query->bindParam(':sex', $sex);
		$query->bindParam(':limb', $limb);
		$query->bindParam(':ability', $ability);
		$query->bindParam(':osebe', $osebe);
		$query->execute();
		print('Информация заполнена правильно. Приходите еще :)');
		exit();
	}
	catch(PDOException $t){
		print('Error : ' . $t->getosebe());
		exit();
	}
}

header('Location: /Information about user/#forms');
?>