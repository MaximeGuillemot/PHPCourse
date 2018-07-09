<?php
class PersonnagesManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function create(Personnages $perso)
    {
        if(!isset($perso))
        {
            trigger_error('Le personnage n\'existe pas.', E_USER_WARNING);
            return;
        }
        
        $q = $this->_db->prepare('INSERT INTO personnages(name, damage) VALUES(:name, :damage)');
        $q->bindValue(':name', (string) $perso->name());
        $q->bindValue(':damage', (int) $perso->damage(), PDO::PARAM_INT);
        $q->execute();
    }

    public function checkAvailability($name)
    {
        $q = $this->_db->prepare('SELECT COUNT(name) FROM personnages WHERE name = :name');
        $q->bindValue(':name', (string) $name);
        $q->execute();
        $result = $q->fetch();
        $q->closeCursor();

        if($result[0] > 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function read($name)
    {
        $name = (string) $name;

        $q = $this->_db->prepare('SELECT * FROM personnages WHERE name = :name');
        $q->bindValue(':name', $name);

        $q->execute();

        return new Personnages($q->fetch());
    }

    public function readList()
    {
        $persos = [];

        $q = $this->_db->prepare('SELECT * FROM personnages');
        $q->execute();
        
        while($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $persos[] = new Personnages($data);
        }

        return $persos;
    }

    public function update(Personnages $perso)
    {
        if(!isset($perso))
        {
            trigger_error('Le personnage demandé n\'existe pas.', E_USER_WARNING);
            return;
        }

        $q = $this->_db->prepare('UPDATE personnages SET name = :name, damage = :damage WHERE id = :id');
        $q->bindValue(':name', (string) $perso->name());
        $q->bindValue(':damage', (int) $perso->damage(), PDO::PARAM_INT);
        $q->bindValue(':id', (int) $perso->id(), PDO::PARAM_INT);
        $q->execute();
    }

    public function delete(Personnages $perso)
    {
        if(!isset($perso))
        {
            trigger_error('Le personnage demandé n\'existe pas.', E_USER_WARNING);
            return;
        }

        $q = $this->_db->prepare('DELETE FROM personnages WHERE id = :id');
        $q->bindValue(':id', (int) $perso->id());
        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
?>