<?php
function loadClass($class)
{
  require $class . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('loadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

$perso1 = new Personnage('Jean', 15, 0, 0);
$perso2 = new Personnage('Paul', 10, 0, 0);

$perso1->etat();
$perso2->etat();

do
{
    $perso1->frapper($perso2);
    $perso2->frapper($perso1);
    $perso1->etat();
    $perso2->etat();
}while($perso1->degats() < 80 && $perso2->degats() < 80);

?>