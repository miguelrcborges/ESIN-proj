<?php
	# falta adicionar code para verificar se o user_email não está já na database
	# falta adicionar code para inserir o user na database

	$email = $_POST['user_email'];
	$pass = $_POST['password'];
	$confirm = $_POST['confirm'];

	# checks if both passwords are equal
	if ($confirm != $pass) {
		header('Location:/register/');
	} else {
		# adicionar code para inserir o user na database
		# passar mensagem para o index de que o login foi feito com sucesso
		header('Location:/')
	}
?>
