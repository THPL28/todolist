
<?php 
    // inicializa variavel erro
	$errors = "";
    

	// conecta com banco de dados
	$db = mysqli_connect("localhost", "root", "", "todo");

    
	// insere a tarefa se o formulario foi enviado
	if (isset($_POST['submit'])) {
		if (empty($_POST['tarefa'])) {
			$errors = "Erro ao adicionar tarefa";
		}else{
			 $tarefa = $_POST['tarefa'];
			$sql = "INSERT INTO tarefa (tarefa) VALUES ('$tarefa')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}	

    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
    
        mysqli_query($db, "DELETE FROM tarefa WHERE id=".$id);
        header('location: index.php');

   }
   if(isset($_POST['delete-all'])){

        $deleteAll = $_POST['delete-all'];
        mysqli_query($db, "DELETE FROM tarefa ");
        header('location: index.php');
   }
    
    ?>








<html> <!-- mãe -->
<link rel="stylesheet" type="text/css" href="style.css">

    <head>

    </head> <!-- filha -->
    <body>

        <div class="container">
            <h1>To do list</h1>


            <div class="form">

                <form method="post" action="index.php" class="input_form">
                <input type="text" name="tarefa" class="input" />
                <button type="submit" name="submit" class="add" >Adicionar
              
             
             
         <?php if (isset($errors)) { ?>
                <p><?php echo $errors; ?></p>
            <?php } ?>
            </div>
            <table class="tasks">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tarefas</th>
                            <th style="width: 60px;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        // 
                        $tasks = mysqli_query($db, "SELECT * FROM tarefa");

                        $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
                            <tr>
                                <td> <?php echo $i; ?> </td>
                                <td class="task"> <?php echo $row['tarefa']; ?> </td>
                                <td class="delete">
                                     
                                    <a  class="delete-all" href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
                                </td>
                            </tr>
                        <?php $i++; } ?>	
                    </tbody>
                </table>
       
                <button name="delete-all" class="delete-all">Deletar Todos</button>

          
        </form>
        </div>
       
    </body> <!-- filha -->

  </html>
