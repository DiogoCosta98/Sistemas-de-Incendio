<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <script>
        function show(c){
            if(c === 'a'){
                document.getElementById("add").style.display="block";
                document.getElementById("del").style.display="none";}
            else{
                document.getElementById("add").style.display="none";
                document.getElementById("del").style.display="block";}
             document.getElementById("a").style.display="none";
             document.getElementById("d").style.display="none";
                }
        function cat(c){
            if(c === '1'){
                document.getElementById("addloc").style.display="block";}
            else if(c === '2'){
                document.getElementById("addev").style.display="block";}
            else if(c==="3"){
                document.getElementById("addp").style.display="block";}
            else if(c==="4"){
                document.getElementById("addm").style.display="block";}  
            else if(c==="5"){
                document.getElementById("adde").style.display="block";}
            else if(c==="6"){
                document.getElementById("rmloc").style.display="block";}
            else if(c==="7"){
                document.getElementById("rmev").style.display="block";}
            else if(c==="8"){
                document.getElementById("rmp").style.display="block";}
            else if(c==="9"){
                document.getElementById("rmm").style.display="block";}
            else if(c==="10"){
                document.getElementById("rme").style.display="block";}
            else if(c === '11'){
                document.getElementById("dtext1").style.display="block";
                document.getElementById("dtext2").style.display="none";
            }
            else if(c === '12'){
                document.getElementById("dtext1").style.display="none";
                document.getElementById("dtext2").style.display="block";
            }
            else{
                document.getElementById("delsc").style.display="block";}
            document.getElementById("b1").style.display="none";
            document.getElementById("b2").style.display="none";
            document.getElementById("b3").style.display="none";
            document.getElementById("b4").style.display="none";
            document.getElementById("b5").style.display="none";
            document.getElementById("b6").style.display="none";
            document.getElementById("b7").style.display="none";
            document.getElementById("b8").style.display="none";
            document.getElementById("b9").style.display="none";
            document.getElementById("b10").style.display="none";
                }
        </script>
    </head>
    <body>
<?php
    try
    {
        include 'config.php';
        
        $addloc = isset($_REQUEST['addlocal']) ? $_REQUEST['addlocal'] : '';
        $addloc2 = isset($_REQUEST['addlocal2']) ? $_REQUEST['addlocal2'] : '';
        $addnumT = isset($_REQUEST['addnumtelefone']) ? $_REQUEST['addnumtelefone'] : '';
        $addiCham = isset($_REQUEST['addiChamada']) ? $_REQUEST['addiChamada'] : '';
        $addnomeP = isset($_REQUEST['addnomePessoa']) ? $_REQUEST['addnomePessoa'] : '';
        $addnumP = isset($_REQUEST['addnumProcesso']) ? $_REQUEST['addnumProcesso'] : '';
        $addnumP2 = isset($_REQUEST['addnumProcesso2']) ? $_REQUEST['addnumProcesso2'] : '';
        $addnumM = isset($_REQUEST['addnumMeio']) ? $_REQUEST['addnumMeio'] : '';
        $addnomeM = isset($_REQUEST['addnomeMeio']) ? $_REQUEST['addnomeMeio'] : '';
        $addnomeE = isset($_REQUEST['addnomeEntidade']) ? $_REQUEST['addnomeEntidade'] : '';
        $addnomeE2 = isset($_REQUEST['addnomeEntidade2']) ? $_REQUEST['addnomeEntidade2'] : '';
        
        $rmloc = isset($_REQUEST['rmlocal']) ? $_REQUEST['rmlocal'] : '';
        $rmnumT = isset($_REQUEST['rmnumtelefone']) ? $_REQUEST['rmnumtelefone'] : '';
        $rmiCham = isset($_REQUEST['rmiChamada']) ? $_REQUEST['rmiChamada'] : '';
        $rmnumP = isset($_REQUEST['rmnumProcesso']) ? $_REQUEST['rmnumProcesso'] : '';
        $rmnumM = isset($_REQUEST['rmnumMeio']) ? $_REQUEST['rmnumMeio'] : '';
        $rmnomeE = isset($_REQUEST['rmnomeEntidade']) ? $_REQUEST['rmnomeEntidade'] : '';
        $rmnomeE2 = isset($_REQUEST['rmnomeEntidade2']) ? $_REQUEST['rmnomeEntidade2'] : '';
        $nomePessoa = isset($_REQUEST['nomePessoa']) ? $_REQUEST['nomePessoa'] : '';
        
        if ($addloc != ''){
            try{
                $prep = $db->prepare("INSERT INTO Local VALUES(:loc)");
                $prep->bindParam(':loc', $addloc);
                $prep->execute();
            }
            catch(Exception $e){echo ("Local ja existe na BD");}
            

        }
        else if ($addnumT != '' && $addiCham!='' && $addnomeP!='' && $addloc2!='' && $addnumP!=''){
            try{
                $prep = $db->prepare("INSERT INTO Local VALUES(:loc2)");
                $prep->bindParam(':loc2', $addloc2);
                $prep->execute();
                
                $prep = $db->prepare("INSERT INTO ProcessoSocorro VALUES(:numProcesso)");
                $prep->bindParam(':numProcesso', $addnumP);
                $prep->execute();
            }
            catch(Exception $e){}
                
                $prep = $db->prepare("INSERT INTO EventoEmergencia VALUES(:numTelefone, :iChamada, :nomePessoa, :loc2, :numProcesso)");
                $prep->bindParam(':numTelefone', $addnumT);
                $prep->bindParam(':iChamada', $addiCham);
                $prep->bindParam(':nomePessoa', $addnomeP);
                $prep->bindParam(':loc2', $addloc2);
                $prep->bindParam(':numProcesso', $addnumP);
                $prep->execute();

        }
        else if ($addnumP2!=''){
            try{
                $prep = $db->prepare("INSERT INTO ProcessoSocorro VALUES(:numProcesso2)");
                $prep->bindParam(':numProcesso2', $addnumP2);
                $prep->execute();
            }
            catch(Exception $e){
                echo("No. de processo ja existe na BD");}
        }
        
        else if ($addnumM != '' && $addnomeM!='' && $addnomeE!=''){
            try{
                $prep = $db->prepare("INSERT INTO EntidadeMeio VALUES(:nomeEntidade)");
                $prep->bindParam(':nomeEntidade', $addnomeE);
                $prep->execute();
            }
            catch(Exception $e){}
        
            $prep = $db->prepare("INSERT INTO Meio VALUES(:numMeio, :nomeMeio, :nomeEntidade)");
            $prep->bindParam(':numMeio', $addnumM);
            $prep->bindParam(':nomeMeio', $addnomeM);
            $prep->bindParam(':nomeEntidade', $addnomeE);
            $prep->execute();
        }
        else if ($addnomeE2!=''){
            try{
                $prep = $db->prepare("INSERT INTO EntidadeMeio VALUES(:nomeEntidade2)");
                $prep->bindParam(':nomeEntidade2', $addnomeE2);
                $prep->execute();
            }
            catch(Exception $e){
                echo("Entidade Meio ja existe na BD");}

        }
        

        else if ($rmloc != ''){
           try{
                $prep = $db->prepare("DELETE FROM Local WHERE moradaLocal=:loc;");
                $prep->bindParam(':loc', $rmloc);
                $prep->execute();
                
                
            }
            catch(Exception $e){echo ("Local nao existe na BD");}
            
        }
        else if ($rmnumT != '' && $rmiCham!=''){
           try{
                $prep = $db->prepare("DELETE FROM EventoEmergencia WHERE numTelefone=:numTel AND instanteChamada=:iCham;");
                $prep->bindParam(':numTel', $rmnumT);
                $prep->bindParam(':iCham', $rmiCham);
                $prep->execute();

                $prep = $db->prepare("DELETE FROM ProcessoSocorro 
                                      WHERE numProcessoSocorro NOT IN(
                                            SELECT numProcessoSocorro FROM EventoEmergencia)
                                      AND numProcessoSocorro NOT IN(
                                            SELECT numProcessoSocorro FROM Acciona)
                                      AND numProcessoSocorro NOT IN(
                                            SELECT numProcessoSocorro FROM Transporta)
                                      AND numProcessoSocorro NOT IN(
                                            SELECT numProcessoSocorro FROM Alocado)
                                      AND numProcessoSocorro NOT IN(
                                            SELECT numProcessoSocorro FROM Audita);");
                $prep->execute();
                $prep = $db->prepare("DELETE FROM Local 
                                      WHERE Local NOT IN(
                                            SELECT Local FROM EventoEmergencia)
                                      AND Local NOT IN(
                                            SELECT Local FROM Vigia);");
                $prep->execute();

                
            }
            catch(Exception $e){echo ("Evento de Emergencia nao existe na BD");}
            
        }
        else if ($rmnumT != '' && $nomePessoa!=''){
           try{
                $prep = $db->prepare("DELETE FROM EventoEmergencia WHERE numTelefone=:numTel AND nomePessoa=:nomeP;");
                $prep->bindParam(':numTel', $rmnumT);
                $prep->bindParam(':nomeP', $nomePessoa);
                $prep->execute();

                $prep = $db->prepare("DELETE FROM ProcessoSocorro 
                                      WHERE numProcessoSocorro NOT IN(
                                            SELECT numProcessoSocorro FROM EventoEmergencia)
                                      AND numProcessoSocorro NOT IN(
                                            SELECT numProcessoSocorro FROM Acciona)
                                      AND numProcessoSocorro NOT IN(
                                            SELECT numProcessoSocorro FROM Transporta)
                                      AND numProcessoSocorro NOT IN(
                                            SELECT numProcessoSocorro FROM Alocado)
                                      AND numProcessoSocorro NOT IN(
                                            SELECT numProcessoSocorro FROM Audita);");
                $prep->execute();
                $prep = $db->prepare("DELETE FROM Local 
                                      WHERE Local NOT IN(
                                            SELECT Local FROM EventoEmergencia)
                                      AND Local NOT IN(
                                            SELECT Local FROM Vigia);");
                $prep->execute();

                
            }
            catch(Exception $e){echo ("Evento de Emergencia nao existe na BD");}
            
        }
        else if ($rmnumP != ''){
           try{
                $prep = $db->prepare("DELETE FROM ProcessoSocorro WHERE numProcessoSocorro=:nProc;");
                $prep->bindParam(':nProc', $rmnumP);
                $prep->execute();
                
                
            }
            catch(Exception $e){echo ("Processo de Socorro nao existe na BD");}
            
        }
        
        else if ($rmnumM != '' && $rmnomeE!=''){
            try{
                $prep = $db->prepare("DELETE FROM Meio WHERE numMeio=:nmeio AND nomeEntidade=:nomeentidade;");
                $prep->bindParam(':nmeio', $rmnumM);
                $prep->bindParam(':nomeentidade', $rmnomeE);
                $prep->execute();
            }
            catch(Exception $e){echo ("Meio nao existe na BD");}
        
        }
        else if ($rmnomeE2 != ''){
           try{
                $prep = $db->prepare("DELETE FROM EntidadeMeio WHERE nomeEntidade=:nomeentidade2;");
                $prep->bindParam(':nomeentidade2', $rmnomeE2);
                $prep->execute();
                
                
            }
            catch(Exception $e){echo ("Entidade Meio nao existe na BD");}
            
        }
        

    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"i.html\">Back</a>");
    }
            
?>
    <div id="add" style="display:none">
        <button type="button"  id="b1" style="position:absolute; width:75px; height:75px;top:80px;left:30px;" onclick="cat('1')"> Local</button>
        <div id="addloc" style="display:none">
            <h3>Insira o Local a adicionar</h3>
            <form action='a.php' method='post'>
                <p>Local: <input type='text' name='addlocal'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b2" style="position:absolute; width:120px; height:75px;top:80px;left:120px;" onclick="cat('2')"> Evento Emerg&ecircncia</button>
        <div id="addev" style="display:none">
            <h3>Insira o Evento de Emerg&ecircncia a adicionar</h3>
            <form action='a.php' method='post'>
                <p>N&uacutemero de telefone: <input type='number' name='addnumtelefone'/></p>
                <p>Instante de chamada: <input type='datetime-local' name='addiChamada'/></p>
                <p>Nome da pessoa: <input type='text' name='addnomePessoa'/></p>
                <p>Local: <input type='text' name='addlocal2'/></p>
                <p>N&uacutemero do processo: <input type='number' name='addnumProcesso'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b3" style="position:absolute; width:75px; height:75px;top:80px;left:255px;" onclick="cat('3')"> Processo Socorro</button>
        <div id="addp" style="display:none">
            <h3>Insira o Processo de Socorro a adicionar</h3>
            <form action='a.php' method='post'>
                <p>n do processo: <input type='number' name='addnumProcesso2'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b4" style="position:absolute; width:75px; height:75px;top:80px;left:350px;" onclick="cat('4')"> Meio</button>
        <div id="addm" style="display:none">
            <h3>Insira o Meio a adicionar</h3>
            <form action='a.php' method='post'>
                <p>n Meio: <input type='number' name='addnumMeio'/></p>
                <p>nome Meio: <input type='text' name='addnomeMeio'/></p>
                <p>nome Entidade: <input type='text' name='addnomeEntidade'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b5" style="position:absolute; width:75px; height:75px;top:80px;left:440px;" onclick="cat('5')"> Entidade Meio</button>
        <div id="adde" style="display:none">
            <h3>Insira a Entidade Meio a adicionar</h3>
            <form action='a.php' method='post'>
                <p>nome Entidade: <input type='text' name='addnomeEntidade2'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        
    </div>
    
    
    
    
    <div id="del" style="display:none">
    
        <button type="button"  id="b6" style="position:absolute; width:75px; height:75px;top:80px;left:30px;" onclick="cat('6')"> Local</button>
        <div id="rmloc" style="display:none">
            <h3>Insira o Local a remover</h3>
            <form action='a.php' method='post'>
                <p>local: <input type='text' name='rmlocal'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b7" style="position:absolute; width:120px; height:75px;top:80px;left:120px;" onclick="cat('7')">Evento Emerg&ecircncia</button>
        <div id="rmev" style="display:none">
            <h3>Insira o Evento de Emergencia a remover</h3>
            <form action='a.php' method='post'>
                <p>Identificar Evento de Emergencia com: </p>
                <button type="button"  id="d1" style="width:300px; height:30px; top:160px; left:30px;" onclick="cat('11')">Instante de chamada</button>
                <button type="button"  id="d2" style="width:300px; height:30px; top:240px; left:30px;" onclick="cat('12')">Nome da pessoa</button>
                <p>Numero de telefone: <input type='text' name='rmnumtelefone'/></p>
                <div id="dtext1" style="display:none">
                    <p>Instante de Chamada: <input type='datetime-local' name='rmiChamada'/></p>
                </div>
                <div id="dtext2" style="display:none">
                    <p>Nome da Pessoa: <input type='text' name='nomePessoa'/></p>
                </div>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
         <button type="button"  id="b8" style="position:absolute; width:75px; height:75px;top:80px;left:255px;" onclick="cat('8')"> Processo de Socorro</button>
        <div id="rmp" style="display:none">
            <h3>Insira o Processo de Socorro a remover</h3>
            <form action='a.php' method='post'>
                <p>n processo: <input type='number' name='rmnumProcesso'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b9" style="position:absolute; width:75px; height:75px;top:80px;left:350px;" onclick="cat('9')"> Meio</button>
        <div id="rmm" style="display:none">
            <h3>Insira o Meio a remover</h3>
            <form action='a.php' method='post'>
                <p>n Meio: <input type='number' name='rmnumMeio'/></p>
                <p>nome Entidade: <input type='text' name='rmnomeEntidade'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b10" style="position:absolute; width:75px; height:75px;top:80px;left:440px;" onclick="cat('10')"> Entidade Meio</button>
        <div id="rme" style="display:none">
            <h3>Insira a Entidade Meio a remover</h3>
            <form action='a.php' method='post'>
                <p>nome da entidade: <input type='text' name='rmnomeEntidade2'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
    </div>
    
    <button type="button"  id="a" style="position:absolute;display:block; width:75px; height:75px;top:80px;left:30px;" onclick="show('a')"> Inserir</button>
    <button type="button"  id="d" style="position:absolute; top:80px; width:75px; height:75px; left:120px;" onclick="show('d')">Remover</button>
        <form action='i.html' method='post'>
        <p><input type='submit' value='Back'/></p>
    </form>
    
    </body>
</html>
