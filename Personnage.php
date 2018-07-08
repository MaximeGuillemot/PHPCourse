<?php
class Personnage
{
    private $_force;
    private $_experience;
    private $_degats;
    private $_name;
    private static $_statique = 'Je suis un attribut statique et suis unique. Si un objet de cette classe me modifie, je suis modiifé pour toutes les autres instances aussi.';
    private static $_compteur = 0;

    const FORCE_PETITE = 20;
    const FORCE_MOYENNE = 50;
    const FORCE_GRANDE = 80;

    public function __construct($name, $force)
    {
        $this->setName($name);
        $this->setForce($force);
        $this->setExperience(0);
        $this->setDegats(0);

        self::setCompteur(self::compteur() + 1);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set' . ucfirst($key);
            
            if(method_exists($this, $method))
            {
                $this->method($value);
            }
        }
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

    public static function parler()
    {
        echo 'Je suis une méthode statique (donc de classe).<br>';
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

        if(in_array($force, [self::FORCE_PETITE, self::FORCE_MOYENNE, self::FORCE_GRANDE]))
        {
            $this->_force = $force;
        }        
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

    public static function setCompteur($compteur)
    {
        self::$_compteur = $compteur;
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

    public static function statique()
    {
        return self::$_statique;
    }

    public static function compteur()
    {
        return self::$_compteur;
    }

}
?>