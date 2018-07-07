<?php
class Personnage
{
    private $_force;
    private $_experience;
    private $_degats;

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

    // Accesseurs - Getters
    public function force()
    {
        return $this->_force;
    }
    
    public function localisation()
    {
        return $this->_localisation;
    }

    public function experience()
    {
        return $this->_experience;
    }

    public function degats()
    {
        return $this->_degats;
    }

}

$perso = new Personnage;
?>