<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
    </head>

    <?php
    try{
        include 'config.php';

        $Local = isset($_REQUEST['moradaLocal']) ? $_REQUEST['moradaLocal'] : '';
        
        if ($Local != ''){
            try{
                $sql = "SELECT DISTINCT numMeio, nomeEntidade 
                        FROM Acciona NATURAL INNER JOIN EventoEmergencia 
                        WHERE moradaLocal = '$Local'
                            AND (numMeio, nomeEntidade) IN 
                                (SELECT numMeio, nomeEntidade 
                                FROM MeioSocorro);";

                $result = $db->query($sql);
                
                echo('<table border="5">');
                $result->setFetchMode(PDO::FETCH_ASSOC);
                while($row=$result->fetch()){
                    echo("<tr>");
                    foreach($row as $key=>$val){
                        echo("<td>$key: $val</td>\n");
                    }
                    echo("</tr>");
                }
                echo "</table>";
                
                
            }
            catch(Exception $e){
                echo ("Local não existe na Base de Dados");
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        }
    }
    catch (PDOException $e){
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"i.html\">Back</a>");
    }
      
        
    ?>

    <body>
    <div id="PS_EE">
        <h3>Insira o local:</h3>
            <form action='f.php' method='post'>
                <p>Local: <input type='text' name='moradaLocal'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        
    </div>
    </body>
</html>
