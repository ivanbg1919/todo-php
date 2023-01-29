<?php 

$todos = [];
if (file_exists('todo.json')) {
    $json = file_get_contents('todo.json');
    $todos = json_decode($json, true);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://bootswatch.com/5/cyborg/bootstrap.min.css" rel="stylesheet">
    <title>Todo App</title>
</head>
<body>

   <div class="container mt-3 text-center"> 
    <h1>Notes</h1>
            <form action="newtodo.php" method="post">
                <input class="form-control-sm" type="text" name="todo_name" placeholder="Enter your todo">
                <button class="btn btn-primary">New Todo</button>
            </form>
            <br>
        <?php foreach( $todos as $todoName => $todo ) : ?>
            <div style="margin-bottom: 20px;">
                <form style="display: inline-block" action="change_status.php" method="post">
                <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">  
                <input type="checkbox" <?php echo $todo['completed'] ? 'checked' : '' ?>>
                </form>        
                <?php echo $todoName ?>
                <form style="display: inline-block" action="delete.php" method="post">
                    <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
                    <button class="btn btn-primary">Delete</button>
                </form>            
            </div>    
        <?php endforeach; ?>    
 </div>

<script>
    const checkboxes = document.querySelectorAll('input[type=checkbox]');
    checkboxes.forEach(ch => {
        ch.onclick = function() {
            this.parentNode.submit();
        };
    })
</script>
</body>
</html>