<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
        body {background-color:burlywood;}
    
        </style>
    </head>
    
    <body class="center">
        <?php
            $str="Music/".$_GET["song"];
            echo '<audio src= '.'"'.$str.'"'.'controls autoplay></audio >';
        ?>
        <br>
        Lyrics:
        <?php
            try{
                $dbhandler =new PDO('mysql:host=127.0.0.1;dbname=music_store_project','root','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $st=explode(".", $_GET['song'] );
                $q='select lyrics from music where music_id ='.'"'.$st[0].'"';
                $query=$dbhandler->query($q);

                echo '<pre>'.$query->fetch()['lyrics'].'<pre>';
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        
        ?>
        
    </body>
</html>