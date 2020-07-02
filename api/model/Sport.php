<?php
class Sport
{
    private $connection;
    private $table = 'sports';

    public $id;
    public $name;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function list()
    {
        $query = 'SELECT * from ' . $this->table . ';';

        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement;
    }

    public function create()
    {
        $query = 'INSERT INTO
                        ' . $this->table . '
                    SET
                        name = :name;';

        $statement = $this->connection->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        
        $statement->bindParam(":name", $this->name);

        $statement->execute();

        return $statement;
    }
}
