<?php
class Personnage
{
    private $_force = 50;
    private $_localication = 'Lyon';
    private $_experience = 1;
    private $_degats = 0;

    // Mutateurs - Setters
    public function setForce($force)
    {
        $this->_force = $force;
    }

    public function setLocalisation($localisation)
    {
        $this->_localisation = $localisation;
    }

    public function setExperience($experience)
    {
        $this->_experience = $experience;
    }

    public function setDegats($degats)
    {
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