<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <script>
        function show(c){
            if(c === 'a'){
                document.getElementById("add").style.display="block";
                document.getElementById("edit").style.display="none";
                document.getElementById("del").style.display="none";}
            else if(c === 'e'){
                document.getElementById("add").style.display="none";
                document.getElementById("edit").style.display="block";
                document.getElementById("del").style.display="none";}
            else{
                document.getElementById("add").style.display="none";
                document.getElementById("edit").style.display="none";
                document.getElementById("del").style.display="block";}
                
             document.getElementById("a").style.display="none";
             document.getElementById("e").style.display="none";
             document.getElementById("d").style.display="none";
                }
                
        function cat(c){
            if(c === '1'){
                document.getElementById("addMC").style.display="block";}
            else if(c === '2'){
                document.getElementById("addMA").style.display="block";}
            else if(c==="3"){
                document.getElementById("addMS").style.display="block";}
            else if(c==="4"){
                document.getElementById("editMC").style.display="block";}  
            else if(c==="5"){
                document.getElementById("editMA").style.display="block";}
            else if(c==="6"){
                document.getElementById("editMS").style.display="block";}
            else if(c==="7"){
                document.getElementById("rmMC").style.display="block";}
            else if(c==="8"){
                document.getElementById("rmMA").style.display="block";}
            else if(c==="9"){
                document.getElementById("rmMS").style.display="block";}
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
                }
                
        </script>
    </head>
    <body>
<?php
    try
    {
        include 'config.php';
        
        $addnumM = isset($_REQUEST['addnumM']) ? $_REQUEST['addnumM'] : '';
        $addnomeE = isset($_REQUEST['addnomeE']) ? $_REQUEST['addnomeE'] : '';
        $addnumM2 = isset($_REQUEST['addnumM2']) ? $_REQUEST['addnumM2'] : '';
        $addnomeE2 = isset($_REQUEST['addnomeE2']) ? $_REQUEST['addnomeE2'] : '';
        $addnumM3 = isset($_REQUEST['addnumM3']) ? $_REQUEST['addnumM3'] : '';
        $addnomeE3 = isset($_REQUEST['addnomeE3']) ? $_REQUEST['addnomeE3'] : '';
        
        $editnumM = isset($_REQUEST['editnumM']) ? $_REQUEST['editnumM'] : '';
        $editnomeE = isset($_REQUEST['editnomeE']) ? $_REQUEST['editnomeE'] : '';
        $editnumM2 = isset($_REQUEST['editnumM2']) ? $_REQUEST['editnumM2'] : '';
        $editnomeE2 = isset($_REQUEST['editnomeE2']) ? $_REQUEST['editnomeE2'] : '';
        $editnumM3 = isset($_REQUEST['editnumM3']) ? $_REQUEST['editnumM3'] : '';
        $editnomeE3 = isset($_REQUEST['editnomeE3']) ? $_REQUEST['editnomeE3'] : '';
        
        $editnomeM = isset($_REQUEST['editnomeM']) ? $_REQUEST['editnomeM'] : '';
        $editnomeM2 = isset($_REQUEST['editnomeM2']) ? $_REQUEST['editnomeM2'] : '';
        $editnomeM3 = isset($_REQUEST['editnomeM3']) ? $_REQUEST['editnomeM3'] : '';

        $rmnumM = isset($_REQUEST['rmnumM']) ? $_REQUEST['rmnumM'] : '';
        $rmnomeE = isset($_REQUEST['rmnomeE']) ? $_REQUEST['rmnomeE'] : '';
        $rmnumM2 = isset($_REQUEST['rmnumM2']) ? $_REQUEST['rmnumM2'] : '';
        $rmnomeE2 = isset($_REQUEST['rmnomeE2']) ? $_REQUEST['rmnomeE2'] : '';
        $rmnumM3 = isset($_REQUEST['rmnumM3']) ? $_REQUEST['rmnumM3'] : '';
        $rmnomeE3 = isset($_REQUEST['rmnomeE3']) ? $_REQUEST['rmnomeE3'] : '';
        

        
        if ($addnumM != '' && $addnomeE!=''){
            try{
                $prep = $db->prepare("INSERT INTO EntidadeMeio VALUES(:nomeEntidade)");
                $prep->bindParam(':nomeEntidade', $addnomeE);
                $prep->execute();
                
                $prep = $db->prepare("INSERT INTO Meio VALUES(:numMeio, NULL, :nomeEntidade);");
                $prep->bindParam(':numMeio', $addnumM);
                $prep->bindParam(':nomeEntidade', $addnomeE);
                $prep->execute();
            }
            catch(Exception $e){}
                $prep = $db->prepare("INSERT INTO MeioCombate VALUES(:numMeio, :nomeEntidade)");
                $prep->bindParam(':numMeio', $addnumM);
                $prep->bindParam(':nomeEntidade', $addnomeE);
                $prep->execute();

        }
        
        else if ($addnumM2!= '' && $addnomeE2!=''){
            try{
                
                $prep = $db->prepare("INSERT INTO EntidadeMeio VALUES(:nomeEntidade)");
                $prep->bindParam(':nomeEntidade', $addnomeE2);
                $prep->execute();
                
                $prep = $db->prepare("INSERT INTO Meio VALUES(:numMeio, NULL, :nomeEntidade);");
                $prep->bindParam(':numMeio', $addnumM2);
                $prep->bindParam(':nomeEntidade', $addnomeE2);
                $prep->execute();
            }
            catch(Exception $e){}
        
                $prep = $db->prepare("INSERT INTO MeioApoio VALUES(:numMeio, :nomeEntidade);");
                $prep->bindParam(':numMeio', $addnumM2);
                $prep->bindParam(':nomeEntidade', $addnomeE2);
                $prep->execute();
        }
        
        else if ($addnumM3 != '' && $addnomeE3!=''){
            try{
                $prep = $db->prepare("INSERT INTO EntidadeMeio VALUES(:nomeEntidade)");
                $prep->bindParam(':nomeEntidade', $addnomeE3);
                $prep->execute();
                
                $prep = $db->prepare("INSERT INTO Meio VALUES(:numMeio, NULL, :nomeEntidade);");
                $prep->bindParam(':numMeio', $addnumM3);
                $prep->bindParam(':nomeEntidade', $addnomeE3);
                $prep->execute();
            }
            catch(Exception $e){}
        
                $prep = $db->prepare("INSERT INTO MeioSocorro VALUES(:numMeio, :nomeEntidade);");
                $prep->bindParam(':numMeio', $addnumM3);
                $prep->bindParam(':nomeEntidade', $addnomeE3);
                $prep->execute();
        }
        
    
        
        else if ($editnumM != '' && $editnomeE!='' && $editnomeM != '' ){
            try{
                $prep = $db->prepare("UPDATE Meio SET (nomeMeio) = (:nomeio) WHERE numMeio=:nmeio AND nomeEntidade=:nomeentidade;");
                $prep->bindParam(':nmeio', $editnumM);
                $prep->bindParam(':nomeentidade', $editnomeE);
                $prep->bindParam(':nomeio', $editnomeM);
                $prep->execute();
            }
            catch(Exception $e){
                echo ("Meio de Combate nao existe na BD");}
        
        }
        
        else if ($editnumM2 != '' && $editnomeE2 !='' && $editnomeM2 != ''){
            try{
                $prep = $db->prepare("UPDATE Meio SET (nomeMeio) = (:nomeio) WHERE numMeio=:nmeio AND nomeEntidade=:nomeentidade;");
                $prep->bindParam(':nmeio', $editnumM2);
                $prep->bindParam(':nomeentidade', $editnomeE2);
                $prep->bindParam(':nomeio', $editnomeM2);
                $prep->execute();
            }
            catch(Exception $e){
                echo ("Meio de Apoio nao existe na BD");}
        
        }
        
        else if ($editnumM3 != '' && $editnomeE3!='' && $editnomeM3!=''){
            try{
                $prep = $db->prepare("UPDATE Meio SET (nomeMeio) = (:nomeio) WHERE numMeio=:nmeio AND nomeEntidade=:nomeentidade;");
                $prep->bindParam(':nmeio', $editnumM3);
                $prep->bindParam(':nomeentidade', $editnomeE3);
                $prep->bindParam(':nomeio', $editnomeM3);
                $prep->execute();
            }
            catch(Exception $e){
                echo ("Meio de Socorro nao existe na BD");}
        
        }      
        
    
        
        else if ($rmnumM != '' && $rmnomeE!=''){
            try{
                $prep = $db->prepare("DELETE FROM MeioCombate WHERE numMeio=:nmeio AND nomeEntidade=:nomeentidade;");
                $prep->bindParam(':nmeio', $rmnumM);
                $prep->bindParam(':nomeentidade', $rmnomeE);
                $prep->execute();

                $prep = $db->prepare("DELETE FROM Meio
                                      WHERE (numMeio, nomeEntidade) NOT IN(
                                            SELECT (numMeio, nomeEntidade) FROM MeioCombate)
                                      AND (numMeio, nomeEntidade) NOT IN(
                                            SELECT (numMeio, nomeEntidade) FROM MeioApoio)
                                      AND (numMeio, nomeEntidade) NOT IN(
                                            SELECT (numMeio, nomeEntidade) FROM MeioSocorro);");
                $prep->execute();


            }
            catch(Exception $e){echo ("Meio de Combate nao existe na BD");}
        
        }
        
        else if ($rmnumM2 != '' && $rmnomeE2!=''){
            try{
                $prep = $db->prepare("DELETE FROM MeioApoio WHERE numMeio=:nmeio AND nomeEntidade=:nomeentidade;");
                $prep->bindParam(':nmeio', $rmnumM2);
                $prep->bindParam(':nomeentidade', $rmnomeE2);
                $prep->execute();

                $prep = $db->prepare("DELETE FROM Meio
                                      WHERE (numMeio, nomeEntidade) NOT IN(
                                            SELECT (numMeio, nomeEntidade) FROM MeioCombate)
                                      AND (numMeio, nomeEntidade) NOT IN(
                                            SELECT (numMeio, nomeEntidade) FROM MeioApoio)
                                      AND (numMeio, nomeEntidade) NOT IN(
                                            SELECT (numMeio, nomeEntidade) FROM MeioSocorro);");
                $prep->execute();
            }
            catch(Exception $e){echo ("Meio de Apoio nao existe na BD");}
        
        } 
        
        else if ($rmnumM3 != '' && $rmnomeE3!=''){
            try{
                $prep = $db->prepare("DELETE FROM MeioSocorro WHERE numMeio=:nmeio AND nomeEntidade=:nomeentidade;");
                $prep->bindParam(':nmeio', $rmnumM3);
                $prep->bindParam(':nomeentidade', $rmnomeE3);
                $prep->execute();

                $prep = $db->prepare("DELETE FROM Meio
                                      WHERE (numMeio, nomeEntidade) NOT IN(
                                            SELECT (numMeio, nomeEntidade) FROM MeioCombate)
                                      AND (numMeio, nomeEntidade) NOT IN(
                                            SELECT (numMeio, nomeEntidade) FROM MeioApoio)
                                      AND (numMeio, nomeEntidade) NOT IN(
                                            SELECT (numMeio, nomeEntidade) FROM MeioSocorro);");
                $prep->execute();
            }
            catch(Exception $e){
                echo ("Meio de Socorro nao existe na BD");}
        
        }
    }
    
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p><br><a href=\"i.html\">Back</a>");
    }
            
?>
    <div id="add" style="display:none">
    
        <button type="button"  id="b1" style="position:absolute; width:75px; height:75px;top:80px;left:30px;" onclick="cat('1')"> Meio de Combate</button>
        <div id="addMC" style="display:none">
            <h3>Insira o Meio de Combate a adicionar</h3>
            <form action='b.php' method='post'>
                <p>Numero do Meio: <input type='number' name='addnumM'/></p>
                <p>Nome da Entidade: <input type='text' name='addnomeE'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b2" style="position:absolute; width:75px; height:75px;top:80px;left:120px;" onclick="cat('2')"> Meio de Apoio</button>
        <div id="addMA" style="display:none">
            <h3>Insira o Meio de Apoio a adicionar</h3>
            <form action='b.php' method='post'>
                <p>Numero do Meio: <input type='number' name='addnumM2'/></p>
                <p>Nome da Entidade: <input type='text' name='addnomeE2'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b3" style="position:absolute; width:75px; height:75px;top:80px;left:220px;" onclick="cat('3')"> Meio de Socorro</button>
        <div id="addMS" style="display:none">
            <h3>Insira o Meio de Socorro a adicionar</h3>
            <form action='b.php' method='post'>
                <p>Numero do Meio: <input type='number' name='addnumM3'/></p>
                <p>Nome da Entidade: <input type='text' name='addnomeE3'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
    </div>
    
    
    
    
    
    <div id="edit" style="display:none">
        
        <button type="button"  id="b4" style="position:absolute; width:75px; height:75px;top:80px;left:30px;" onclick="cat('4')"> Meio de Combate</button>
        <div id="editMC" style="display:none">
            <h3>Insira o Meio de Combate a editar</h3>
            <form action='b.php' method='post'>
                <p>Numero do Meio a editar: <input type='number' name='editnumM'/></p>
                <p>Nome da Entidade a editar: <input type='text' name='editnomeE'/></p>
                <p>Nome do Meio novo: <input type='text' name='editnomeM'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b5" style="position:absolute; width:75px; height:75px;top:80px;left:120px;" onclick="cat('5')"> Meio de Apoio</button>
        <div id="editMA" style="display:none">
            <h3>Insira o Meio de Apoio a editar</h3>
            <form action='b.php' method='post'>
                <p>Numero do Meio a editar: <input type='number' name='editnumM2'/></p>
                <p>Nome da Entidade a editar: <input type='text' name='editnomeE2'/></p>
                <p>Nome de Meio novo: <input type='text' name='editnomeM2'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b6" style="position:absolute; width:75px; height:75px;top:80px;left:220px;" onclick="cat('6')"> Meio de Socorro</button>
        <div id="editMS" style="display:none">
            <h3>Insira o Meio de Socorro a editar</h3>
            <form action='b.php' method='post'>
                <p>Numero do Meio a editar: <input type='number' name='editnumM3'/></p>
                <p>Nome da Entidade a editar: <input type='text' name='editnomeE3'/></p>
                <p>Nome do Meio novo: <input type='text' name='editnomeM3'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
    
    
    </div>
    
    
    
    
    
    
    <div id="del" style="display:none">
    
        <button type="button"  id="b7" style="position:absolute; width:75px; height:75px;top:80px;left:30px;" onclick="cat('7')"> Meio de Combate</button>
        <div id="rmMC" style="display:none">
            <h3>Insira o Meio de Combate a remover</h3>
            <form action='b.php' method='post'>
                <p>Numero do Meio: <input type='number' name='rmnumM'/></p>
                <p>Nome da Entidade: <input type='text' name='rmnomeE'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b8" style="position:absolute; width:75px; height:75px;top:80px;left:120px;" onclick="cat('8')"> Meio de Apoio</button>
        <div id="rmMA" style="display:none">
            <h3>Insira o Meio de Apoio a remover</h3>
            <form action='b.php' method='post'>
                <p>Numero do Meio: <input type='number' name='rmnumM2'/></p>
                <p>Nome da Entidade: <input type='text' name='rmnomeE2'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
        <button type="button"  id="b9" style="position:absolute; width:75px; height:75px;top:80px;left:220px;" onclick="cat('9')"> Meio de Socorro</button>
        <div id="rmMS" style="display:none">
            <h3>Insira o Meio de Socorro a remover</h3>
            <form action='b.php' method='post'>
                <p>Numero do Meio: <input type='number' name='rmnumM3'/></p>
                <p>Nome da Entidade: <input type='text' name='rmnomeE3'/></p>
                <p><input type='submit' value='Submit'/></p>
            </form>
        </div>
        
    </div>
    
    <button type="button"  id="a" style="position:absolute;display:block; width:75px; height:75px;top:80px;left:30px;" onclick="show('a')"> Inserir</button>
    <button type="button"  id="e" style="position:absolute; width:75px; height:75px;top:80px;left:120px;" onclick="show('e')"> Editar</button>
    <button type="button"  id="d" style="position:absolute; top:80px; width:75px; height:75px; left:210px;" onclick="show('d')">Remover</button>
    <form action='i.html' method='post'>
        <p><input type='submit' value='Back'/></p>
    </form>
    
    </body>
</html>
