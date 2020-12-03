<!-- INCLUDE SERVER -->
<?php include './server/form-server.php' ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="icon" href="img/favicon.png" type="image/png">

		<!-- FONT AWESOME -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- GOOGLE FONTS -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<!-- JQUERY UI -->
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />

		<!-- SITE CSS FILE -->
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		
		<!-- TITLE -->
		<title>Todo List App</title>
	</head>
	<body>
		<!-- ##################### BANNER ################### -->
		<div class="banner">
			<div class="wrapper">
				<h3>Todo App</h3>
			</div>
		</div>
		<!-- ##################### TODOS ################### -->
		<div class="todos">
			<!-- TODO FORM -->
			<form id="todoForm">
				<input type="text" placeholder="Todo title ...." id="title" autofocus autocomplete="off">
				<button type="submit" class="button">Add <span>todo</span> </button>
			</form>
			<!-- TODO NOTIFICATION MESSAGE -->
			<div class="form-message hide">
				<p class="form-message-title"></p>
			</div>

			<!-- TODO LIST -->
			<ul class="todo-list" id="todo-list">
				<?php getTodos(); ?>
			</ul>
		</div>
		<!-- ##################### FOOTER ################### -->
		<footer>
			<div class="footer-copyright">
				<p>Copyright &copy; <span id="year"></span> Todoapp | Designed by <a href="https://victornwakwue.netlify.app">Victor Nwakwue</a>.</p>
			</div>
		</footer>
		
		<!-- SCRIPT TAG -->
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<script src="js/main.js"></script>
	</body>
</html>