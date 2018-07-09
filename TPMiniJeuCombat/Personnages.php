<?php
class Personnages
{
    private $_id;
    private $_name;
    private $_damage;

    const PERSO_VIVANT = 1;
    const PERSO_MORT = 2;
    const CIBLE_MORTE = 3;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set' . ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
    
    public function frapper(Personnages $cible)
    {
        if(!isset($cible))
        {
            trigger_error('Ce personnage n\'existe pas.', E_USER_WARNING);
            return;
        }

        if($this->damage() >= 100)
        {
            trigger_error('Un personnage mort ne peut pas attaquer.', E_USER_WARNING);
            return;
        }

        if($cible->damage() >= 100)
        {
            trigger_error('La cible est déjà morte.', E_USER_WARNING);
            return;
        }

        $cible->setDamage($cible->damage() + rand(0, 10));
        $this->setDamage($this->damage() + rand(0, 10));

        if($cible->damage() >= 100)
        {
            echo $this->name() . ' frappe ' . $cible->name() . ' et achève sa cible. ' . $cible->name() . ' est mort(e).';
            return self::CIBLE_MORTE;
        }
        elseif($this->damage() >= 100)
        {
            echo $this->name() . ' a reçu un coup fatal. Votre personnage est mort.';
            return self::PERSO_MORT;
        }
        else
        {
            echo $this->name() . ' frappe ' . $cible->name() . ' dont les dégâts atteignent désormais la valeur de ' . $cible->damage() . '<br>';
            echo $cible->name() . ' frappe ' . $this->name() . ' dont les dégâts atteignent désormais la valeur de ' . $this->damage();
            return self::PERSO_VIVANT;
        }
    }

    public function setId($id)
    {
        $id = (int) $id;

        if(!is_int($id) || $id < 0)
        {
            trigger_error('L\'ID d\'un personnage doit être un entier positif.', E_USER_WARNING);
            return;
        }

        $this->_id = $id;
    }

    public function setName($name)
    {
        if(!is_string($name) || strlen($name) > 255)
        {
            trigger_error('Le nom entré est trop grand ou n\'est pas une chaîne de caractères.', E_USER_WARNING);
            return;
        }

        $this->_name = $name;
    }

    public function setDamage($damage)
    {
        $damage = (int) $damage;

        if(!is_int($damage) || $damage < 0)
        {
            trigger_error('Les dégâts doivent être représentés par un entier positif.', E_USER_WARNING);
            return;
        }

        $this->_damage = $damage;

        if($this->damage() >= 100)
        {
            $this->_damage = 100;
        }
    }

    public function id() { return $this->_id; }
    public function name() { return $this->_name; }
    public function damage() { return $this->_damage; }


}
?>