<?php

function classLoader($class)
{
    require $class . '.php'; 
}
spl_autoload_register('classLoader');

try
{
    $db = new PDO('mysql:host=localhost;dbname=combat;charset=utf8', 'root', '');
    $manager = new PersonnagesManager($db);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if(isset($_POST['name']))
{
    $name = htmlspecialchars($_POST['name']);
    $perso = new Personnages(array('name' => $name, 'damage' => 0));
    if($manager->checkAvailability($perso->name()))
    {
        $manager->create($perso);
        header('Location: ' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?name=' . $perso->name());
    }
    else
    {
        echo 'Le nom est déjà pris !';
    }
}
elseif(isset($_GET['name']))
{
    $name = htmlspecialchars($_GET['name']);
    $perso = $manager->read($name);
    $listePersos = $manager->readList();
    
    //var_dump($cible);
    do
    {
        $cible = $listePersos[array_rand($listePersos)];
    }while($cible == $perso);
    
    $statut = $perso->frapper($cible);
    if($statut == Personnages::CIBLE_MORTE)
    {
        $manager->delete($cible);
    }
    elseif($statut == Personnages::PERSO_MORT)
    {
        $manager->delete($perso);
        header('Location: index.php');
    }
    else
    {
        $manager->update($cible);
        $manager->update($perso);
    }
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mini jeu de combat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table
        {
            border-collapse: collapse;
        }
        th, td 
        {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>Mini jeu de combat</h1>

    <?php
    if(!isset($_GET['name']))
    {
    ?>
        <form method="post">
            Nom du personnage à créer : <br>
            <input type="text" name="name"><br>
            <input type="submit" value="Créer">
        </form>
    <?php
    }
    else
    {
    ?>
        <form method="post">
            Combattre contre un personnage aléatoire :<br>
            <input type="submit" value="Combattre">
        </form>
    <?php
    }
    ?>
    

    <p>
        Liste des personnages : <br>

        <table>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Dégâts</th>
            </tr>
            <?php
                $listPersos = $manager->readList();
                foreach($listPersos as $value)
                {
                    echo '<tr>',
                         '<td>' . $value->id() . '</td>',
                         '<td>' . $value->name() . '</td>',
                         '<td>' . $value->damage() . '</td>',
                         '</tr>';
                }
            ?>
        </table>
    </p>
</body>
</html>


<!--
    Chaque visiteur pourra créer un personnage (pas de mot de passe requis pour faire simple) avec lequel il pourra frapper d'autres personnages.
    Le personnage frappé se verra infliger un certain degré de dégâts.

    Un personnage est défini selon 2 caractéristiques :

    Son nom (unique).
    Ses dégâts.

    Les dégâts d'un personnage sont compris entre 0 et 100. Au début, il a bien entendu 0 de dégât. 
    Chaque coup qui lui sera porté lui fera prendre 5 points de dégâts.
    Une fois arrivé à 100 points de dégâts, le personnage est mort (on le supprimera alors de la BDD).




-->