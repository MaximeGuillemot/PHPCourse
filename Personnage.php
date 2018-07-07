<?php
class Personnage
{
    private $_force;
    private $_experience;
    private $_degats;
    private $_name;

    public function __construct($name, $force, $experience, $degats)
    {
        $this->setName($name);
        $this->setForce($force);
        $this->setExperience($experience);
        $this->setDegats($degats);
    }

    public function frapper(Personnage $cible)
    {
        $cible->setDegats($cible->degats() + $this->force());
    }

    public function etat()
    {
        echo $this->name() . ' possède ' . $this->force() . ' points en force, ' . $this->experience() . 
        ' points d\'expérience, et a encaissé ' . $this->degats() . ' points de dégâts.<br>';
    }

    // Mutateurs - Setters
    public function setForce($force)
    {
        if(!is_int($force))
        {
            trigger_error('La force d\' un personnage doit être un nombre entier.', E_USER_WARNING);
            return;
        }

        if($force < 0 || $force > 100)
        {
            trigger_error('La force doit être comprise entre 0 et 100.', E_USER_WARNING);
            return;
        }
        
        $this->_force = $force;
    }

    public function setExperience($experience)
    {
        if(!is_int($experience))
        {
            trigger_error('L\'expérience doit être un nombre entier.', E_USER_WARNING);
            return;
        }

        if($experience < 0 || $experience > 100)
        {
            trigger_error('L\'expérience doit être comprise entre 0 et 100.', E_USER_WARNING);
            return;
        }

        $this->_experience = $experience;
    }

    public function setDegats($degats)
    {
        if(!is_int($degats))
        {
            trigger_error('La valeur de dégâts doit un être un nombre entier.', E_USER_WARNING);
            return;
        }

        if($degats < 0 || $degats > 100)
        {
            trigger_error('Les dégâts doivent être compris entre 0 et 100.', E_USER_WARNING);
            return;
        }

        $this->_degats = $degats;
    }

    public function setName($name)
    {
        if(!is_string($name))
        {
            trigger_error('Le nom doit être une chaîne de caractères.', E_USER_WARNING);
            return;
        }

        $this->_name = $name;
    }

    // Accesseurs - Getters
    public function force()
    {
        return $this->_force;
    }

    public function experience()
    {
        return $this->_experience;
    }

    public function degats()
    {
        return $this->_degats;
    }

    public function name()
    {
        return $this->_name;
    }

}

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
}while($perso1->degats() < 80 && $perso2->degats() < 80)
?>