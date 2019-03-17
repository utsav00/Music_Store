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
        
                <?php
                    try{
                        $dbhandler =new PDO('mysql:host=127.0.0.1;dbname=music_store_project','root','');
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $query=$dbhandler->query('select * from music');
                        
                        
                        //query 1: displaying all songs
                        echo 'all songs:<br>';
                        echo '<form action="player.php" method="GET">
                                <select name="all_song">';
                        
                        while($r=$query->fetch()){
                            echo '<option value='.$r['music_id'].'>'.$r['music_name'].'</option>';
                        }
                        echo '<input type="Submit" name="Play_all" value="play_all">';
                        echo '</select></form>';
                        
                        
                        echo '<br><br>';
                        
                        echo 'hindi songs:<br>';
                        echo '<form action="player.php" method="GET">
                                <select name="hindi_song">';
                        $query_hindi=$dbhandler->query("select * from music where language='Hindi' or language='hindi'");
                        while($r=$query_hindi->fetch()){
                            echo '<option value='.$r['music_id'].'>'.$r['music_name'].'</option>';
                        }
                        echo '<input type="Submit" name="Play_hindi" value="play_hindi">';
                        echo '</select></form>';
                        
                        
                        echo '<br><br>';
                        
                        echo 'english songs:<br>';
                        echo '<form action="player.php" method="GET">
                                <select name="english_song">';
                        $query_english=$dbhandler->query("select * from music where language='English' or language='english'");
                        while($r=$query_english->fetch()){
                            echo '<option value='.$r['music_id'].'>'.$r['music_name'].'</option>';
                        }
                        echo '<input type="Submit" name="Play_english" value="play_english">';
                        echo '</select></form>';
                    }
                    catch(PDOException $e){
                        echo $e->getMessage();
                        die();
                    }
                ?>
            
            
        
    </body>
</html>
