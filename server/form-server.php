<?php

//connect to the database
require 'dbconfig.php';

// POST TODOS
if (isset($_POST['save'])) {
	// REMOVE SPECIAL CHARACTERS
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$todo_order_no = $_POST['todo_order_no'];



	// INSERT TODOS TO DATABASE
	$sqlQuery = "INSERT INTO todos (title, todo_order_no) VALUES ('$title', '$todo_order_no')";
		
		// IF SAVE, GET THE TOTO ADDED AND DISPLAY 
		if (mysqli_query($conn, $sqlQuery)) {

			// AUTO GENERATE ID
			$id = mysqli_insert_id($conn);

			$saved_todo = 
			'<li class="todo-list-item ui-sortable-handle" data-todo-id="'.$id.'" draggable="true">
					<span class="title">'. $title .'</span>
					<i class="fa fa-trash delete" data-id=" '.$id.'"></i>
			</li>';

	    	echo $saved_todo;
		}

		exit(); 
}


// DELETE TODOS
if (isset($_GET['delete'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM todos WHERE id=" .$id;
	mysqli_query($conn, $sql);

	exit();
}

// UPDATE ORDER
if(isset($_GET["order"])) {
	$order  = explode(",",$_GET["order"]);
	for($i=0; $i < count($order);$i++) {
		$sql = "UPDATE todos SET todo_order_no='" . $i . "' WHERE id=". $order[$i];		
		mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));	
	}
	exit();
}

// GET LOGGEDIN USER DATA
function getTodos() {
    global $conn;

    $query="SELECT * FROM todos ORDER BY todo_order_no ASC";
    $result = mysqli_query($conn,$query) or die( mysqli_error($conn)); 

    while($todos=mysqli_fetch_array($result)) { 
    	$title = $todos['title'];
	    $id = $todos['id'];

  		echo '<li class="todo-list-item ui-sortable-handle" data-todo-id="'.$id.'" draggable="true">
					<span class="title">'. $title .'</span>
					<i class="fa fa-trash delete" data-id=" '.$id.'"></i>
				</li>';
  	}

}

 ?>
