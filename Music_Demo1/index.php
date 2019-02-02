<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
        body {
            background-color:teal;
        }
        </style>
    </head>
    
    <body class="center">
        <form action="player.php" method="GET">
        
            <select name="song">

                <?php
                    try{
                        $dbhandler =new PDO('mysql:host=127.0.0.1;dbname=music_store_project','root','');
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $query=$dbhandler->query('select * from music');
                        while($r=$query->fetch()){
                            echo '<option value='.$r['music_id'].'.mp3>'.$r['music_name'].'</option>';
                        }
                    }
                    catch(PDOException $e){
                        echo $e->getMessage();
                        die();
                    }
                ?>
            </select>
            <input type="Submit" name="Play" value="play">
        </form>
    </body>
</html>
