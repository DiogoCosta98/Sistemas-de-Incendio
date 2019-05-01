<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <script>
        function show(c){
            if(c === 'a'){
                document.getElementById("PS_Meio").style.display="block";
                document.getElementById("PS_EE").style.display="none";}
            else{
                document.getElementById("PS_Meio").style.display="none";
                document.getElementById("PS_EE").style.display="block";
            }

            document.getElementById("a").style.display="none";
            document.getElementById("d").style.display="none";
        }

        function cat(c){
            if(c === '1'){
                document.getElementById("dtext1").style.display="block";
                document.getElementById("dtext2").style.display="none";
            }

            else if(c === '2'){
                document.getElementById("dtext1").style.display="none";
                document.getElementById("dtext2").style.display="block";
            }
        }
        </script>
    </head>

    <?php
    try
    {
        include 'config.php';

        $numPS = isset($_REQUEST['numProcessoSocorro']) ? $_REQUEST['numProcessoSocorro'] : '';
        $nomeEnt = isset($_REQUEST['nomeEntidade']) ? $_REQUEST['nomeEntidade'] : '';
        $numMeio = isset($_REQUEST['numMeio']) ? $_REQUEST['numMeio'] : '';
        $numTele = isset($_REQUEST['numTelefone']) ? $_REQUEST['numTelefone'] : '';
        $instCham = isset($_REQUEST['instanteChamada']) ? $_REQUEST['instanteChamada'] : '';
        $nomePessoa = isset($_REQUEST['nomePessoa']) ? $_REQUEST['nomePessoa'] : '';
        
       if ($numPS != '' && $numMeio!='' && $nomeEnt != ''){
           try{
                $prep = $db->prepare("INSERT INTO Acciona VALUES(:numMeio, :nomeEnt, :numProcSocorro)");
                $prep->bindParam(':numMeio', $numMeio);
                $prep->bindParam(':nomeEnt', $nomeEnt);
                $prep->bindParam(':numProcSocorro', $numPS);
                $prep->execute();
            }
             catch (PDOException $e){ echo("<p>ERROR: {$e->getMessage()}</p>"); }
            catch(Exception $e){echo ("Processo de Socorro ou Meio não existe na Base de Dados");}   
        }
        else if ($numPS != '' && $numTele!='' && $instCham != ''){
            try{
                $db_instCham = date('Y-m-d H:i:s', strtotime($instCham));
                $prep = $db->prepare("UPDATE EventoEmergencia SET numProcessoSocorro = $numPS WHERE numTelefone = '$numTele' AND instanteChamada = '$db_instCham'");
                $prep->execute();
            }
             catch (PDOException $e){ echo("<p>ERROR: {$e->getMessage()}</p>"); }
            catch(Exception $e){echo ("Processo de Socorro ou Identificador do Evento de Emergencia nao existe na Base de Dados");}  
        }
        else if ($numPS != '' && $numTele!='' && $nomePessoa != ''){
            try{
                $prep = $db->prepare("UPDATE EventoEmergencia SET numProcessoSocorro = $numPS WHERE numTelefone = '$numTele' AND nomePessoa = '$nomePessoa'");
                $prep->execute();
            }
             catch (PDOException $e){ echo("<p>ERROR: {$e->getMessage()}</p>"); }
            catch(Exception $e){echo ("Processo de Socorro ou Identificador do Evento de Emergencia nao existe na Base de Dados");}  
        }
    }

    catch (PDOException $e){echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"i.html\">Back</a>");}         
    ?>

    <body>
    <div id="PS_Meio" style="display:none">
        <h3>Escolha o Processo Socorro e o Meio</h3>
            <form action='d.php' method='post'>
                <p>Numero do Processo de Socorro: <input type='number' name='numProcessoSocorro'/></p>
                <p>Numero do Meio: <input type='number' name='numMeio'/></p>
                <p>Nome de Entidade: <input type='text' name='nomeEntidade'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        
    </div>

    <div id="PS_EE" style="display:none">
        <h3>Escolha o Processo Socorro e o Evento de Emergencia</h3>
            <form action='d.php' method='post'>
                <p>Numero do Processo de Socorro: <input type='number' name='numProcessoSocorro'/></p>
                <p>Identificar Evento de Emergencia com: </p>
                <button type="button"  id="d1" style="width:300px; height:30px; top:160px; left:30px;" onclick="cat('1')">Instante de chamada</button>
                <button type="button"  id="d2" style="width:300px; height:30px; top:240px; left:30px;" onclick="cat('2')">Nome da pessoa</button>
                <p>Numero de telefone: <input type='text' name='numTelefone'/></p>
                <div id="dtext1" style="display:none">
                    <p>Instante de Chamada: <input type='datetime-local' name='instanteChamada'/></p>
                </div>
                <div id="dtext2" style="display:none">
                    <p>Nome da Pessoa: <input type='text' name='nomePessoa'/></p>
                </div>
                <p><input type='submit' value='Submit'/></p>
            </form>
        
    </div>

   
    
    <button type="button"  id="a" style="position:absolute;display:block; width:200px; height:75px; top:80px; left:30px;" onclick="show('a')"> Associar Processo de Socorro a Meio</button>
    <button type="button"  id="d" style="position:absolute; width:200px; height:75px; top:160px; left:30px;" onclick="show('d')">Associar Processo de Socorro a Evento de Emergencia</button>
    
    </body>
</html>
