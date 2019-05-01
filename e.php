<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
    </head>

    <?php
    try{
        include 'config.php';

        $numPS = isset($_REQUEST['numProcessoSocorro']) ? $_REQUEST['numProcessoSocorro'] : '';
        
        if ($numPS != ''){
            try{
                $sql = "SELECT numMeio, nomeEntidade FROM Acciona WHERE numProcessoSocorro=$numPS;";
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
                echo ("Processo de Socorro não existe na Base de Dados");
            }
        }
    }
    catch (PDOException $e){
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"i.html\">Back</a>");
    }
      
        
    ?>

    <body>
    <div id="PS_EE">
        <h3>Insira o numero do Processo de Socorro:</h3>
            <form action='e.php' method='post'>
                <p>Numero do Processo de Socorro: <input type='number' name='numProcessoSocorro'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        
    </div>
    </body>
</html>
