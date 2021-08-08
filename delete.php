<script type="text/javascript">  

     if (confirm('Are you sure you want to proceed?')==true){
        console.log('yes');
        "<?php
            $conn = new mysqli("localhost", "root", "root","mydb");

            $userId = $_GET['id'];

            $deleteQuery = "DELETE FROM myuser WHERE id=$userId";

            $result = $conn->query($deleteQuery);
            header('Location: server.php');
            ?>"
    } else {
        console.log('no');
        <?php 
        header('Location: server.php');  
        ?>
    }
</script>


