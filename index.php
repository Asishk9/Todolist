<?php  
    include('home.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css"/>
    <title>Todo List App</title>
</head>
<body>
    <div class="container">
      <div id="newtask">
        <?php include('alert.php') ?>
        <h3>Todo List Tasks</h3>
        <form action="index.php" method="post" id="taskform">
            <input type="hidden" name="id" value= "<?php if($editing) { echo $taskData['id']; } ?>" />
            <input type="text" name="task" id="task" placeholder="Enter the Task to be done..." value= "<?php if($editing) { echo $taskData['task']; } ?>" />
            <button type="submit" name="submit" id="add"><?php if($editing) { echo "Update"; } else { echo "Add" ; } ?></button>
        </form>
      </div>

      <div id="tasks">
        <?php
            if(!empty($tasks)) {
                foreach($tasks as $t) {
        ?>
        <div class="task">
            <span><?php echo $t['task'] ?></span>
            <a href="index.php?action=edit&id=<?php echo $t['id'] ?>" class="edit button"><i class="fa-regular fa-pen-to-square"></i></a>
            <a onclick="return confirm('Do you want to delete this record?')" href="index.php?action=delete&id=<?php echo $t['id'] ?>" class="delete button"><i class="fa-solid fa-trash"></i></a>
        </div>
        <?php }} ?>
      </div>
    </div>
    <script src="app.js"></script>
</body>
</html>