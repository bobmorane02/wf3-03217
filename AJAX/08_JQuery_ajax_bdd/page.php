<?php
    $pdo = new PDO('mysql:host=localhost;dbname=entreprise','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $r = $pdo->query("SELECT prenom,id_employes FROM employes");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
        body {
            max-width: 700px;
            margin: auto;
        }
        table {
            border-collapse: collapse;
            border: none;
        }

        td,th {
            padding: 10px;
            height: 40px;
        }

        select,input {
            margin: 10px 0;
            height: 40px;
            border-radius: 5px;
        }

        label,select,input,table {
            width: 100%;
        }

        #resultat {
            background-color: #dadada;
            border-radius: 10px;
            overflow: hidden;
        }

    </style>        
</head>
<body>
    <form id="mon_form">
        <label>Prénom</label>
        <select id="choix">
            <?php
                // récupérer tous les prénoms présentdans la BDD entreprisesur la table employés et mettre l'id_employes dans la value
                while ($rep = $r->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value='.$rep['id_employes'].'>'.$rep['prenom'].'</option>';
                }
            ?>
        </select>
        <br>
        <input type="submit" id="valider" value="Valider" />
    </form>
    <hr>
    <div id="resultat"></div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $("#mon_form").on('submit',function(e){
                e.preventDefault();
                var param = "id="+$("#choix").val();
                $.post("ajax.php",param,function(reponse){
                    $("#resultat").html(reponse.resultat);
                },"json");
            });
        });
    </script>
</body>
</html>