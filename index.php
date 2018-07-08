<?php
function loadClass($class)
{
  require $class . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('loadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

echo '<br>Nombre de personnages instanciés : ' . Personnage::compteur() . '<br>';
$perso1 = new Personnage('Jean', Personnage::FORCE_PETITE);
echo '<br>Nombre de personnages instanciés : ' . Personnage::compteur() . '<br>';
$perso2 = new Personnage('Paul', Personnage::FORCE_MOYENNE);
echo '<br>Nombre de personnages instanciés : ' . Personnage::compteur() . '<br>';

$perso1->etat();
$perso2->etat();

do
{
    $perso1->frapper($perso2);
    $perso2->frapper($perso1);
    $perso1->etat();
    $perso2->etat();
}while($perso1->degats() < 80 && $perso2->degats() < 80);

Personnage::parler();

echo Personnage::statique();


$perso3 = new Personnage([
    'nom' => 'Victor',
    'forcePerso' => 5,
    'degats' => 0,
    'niveau' => 1,
    'experience' => 0
  ]);
      
  $db = new PDO('mysql:host=localhost;dbname=tests', 'root', '');
  
  $manager = new PersonnagesManager($db);
  $manager->add($perso);

?>