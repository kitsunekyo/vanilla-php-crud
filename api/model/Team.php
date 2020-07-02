<?php
class Team
{
    private $connection;
    private $table = 'teams';

    public $id;
    public $name;
    public $sport_fk;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function get() {
        $sql = "SELECT name FROM " . $this->table . " WHERE id = ?";
        $statement = $this->connection->prepare($sql);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $statement->bindParam(1, $this->id);

        if ($statement->execute()) {
            return $statement;
        }
        return $statement;
    }

    public function list()
    {
        $query = 'SELECT t.id, t.name, s.name as sport FROM ' . $this->table . ' t LEFT JOIN sports s ON t.sport_fk = s.id;';

        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement;
    }

    public function create()
    {
        $query = 'INSERT INTO
                        ' . $this->table . '
                    SET
                        name = :name, 
                        sport_fk = :sport_fk';

        $statement = $this->connection->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->sport_fk=htmlspecialchars(strip_tags($this->sport_fk));

        $statement->bindParam(":name", $this->name);
        $statement->bindParam(":sport_fk", $this->sport_fk);

        $statement->execute();

        return $statement;
    }
}
