<?php
    session_start();
    include('database.php');
    include('tasks.php');
    $obj = new Tasks;
    
    if(isset($_POST['submit'])) {
        // Insert Data in the Table
        $task = $_POST['task'];
        $id = $_POST['id'];
        $created_at = $updated_at = date("Y-m-d H:i:s");

        //Update
        if(!empty($id)) {
            $sql = "UPDATE todolist set task = '".$task."', updated_at = '".$updated_at."' where id = ".$id;
            $res = $obj->executeQuery($sql);
            if($res) {
                $_SESSION['success'] = "Task has been updated successfully";
            }
            else {
                $_SESSION['error'] = "Something went wrong, please try again later";
            }
        }   
        else {
            $sql = "INSERT INTO todolist (task, created_at, updated_at) VALUES ('".$task."', '".$created_at."', '".$updated_at."')";
            $res = $obj->executeQuery($sql);

            if($res) {
                $_SESSION['success'] = "Task has been created successfully";
            }
            else {
                $_SESSION['error'] = "Something went wrong, please try again later";
            }
        }
        
        session_write_close();
        header("LOCATION:index.php");
    }

    //Get all Tasks
    $tasks = $obj->getAllTasks();

    //Get Task
    $editing = false;
    if(isset($_GET['action']) && $_GET['action']  === 'edit') {
        $taskData = $obj->getTask($_GET['id']);
        $editing = true;
    }

    //Delete Task
    if(isset($_GET['action']) && $_GET['action']  === 'delete') {
        $sql = "DELETE FROM todolist WHERE id = ".$_GET['id'];
        $res = $obj->executeQuery($sql);
        if($res) {
            $_SESSION['success'] = "Task has been deleted successfully";
        }
        else {
            $_SESSION['error'] = "Something went wrong, please try again later";
        }

        session_write_close();
        header("LOCATION:index.php");
    }
?>
