<script type="text/javascript">  

     if (confirm('Are you sure you want to proceed?')==true){
        console.log('yes');
        "<?php
            require_once('user.php');

            if($_COOKIE == null){
                echo "cookies is null";
                header('location:index.php');
            }


            $user = new user();
            $isDeleted = $user->delete($_GET['id']);
            if($isDeleted){
                header('Location: server.php');
            }

            ?>"
    } else {
        console.log('no');
        <?php 
        header('Location: server.php');  
        ?>
    }
</script>


