    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <script>
        function show(c){
            if(c === 'a'){
                processoSocorro = 'on'
            else{
                meios = 'on'
            }

            document.getElementById("a").style.display="none";
            document.getElementById("d").style.display="none";
        }
        </script>
    </head>



    <?php
    try{
        include 'config.php';
        
        try{
                $sql = "SELECT * FROM ProcessoSocorro;";

                $result = $db->query($sql);
                
                echo('<h2>Processos de Socorro:</h2>');
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
                
                echo "<br></br><br></br>";
                echo('<h2>Meios:</h2>');
                $sql = "SELECT * FROM Meio;";

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
            catch(Exception $e){echo("<p>ERROR: {$e->getMessage()}</p>");}
    }
    catch (PDOException $e){
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"i.html\">Back</a>");
    }
      
        
    ?>

</html>