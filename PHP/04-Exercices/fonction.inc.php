<?php
// voici une fonction qui permet de retourner le prix d'un fruit en fonction d'un poid.

function calcul($fruit,$poid){
    switch($fruit){
        case 'cerises' : $prix_kg = 5.76;break;
        case 'bananes' : $prix_kg = 1.09;break;
        case 'pommes' : $prix_kg = 1.61;break;
        case 'peches' : $prix_kg = 3.23;break;
        default : return 'Fruit inexistant';        
    }
    $resultat = $poid * $prix_kg/1000; // calcule le prix total selon un poids donné en grammes
    return 'Les '.$fruit.' coûtent '.$resultat.' euros pour '.$poid.' grammes'; 
}