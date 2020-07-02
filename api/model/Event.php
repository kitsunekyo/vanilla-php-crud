<?php
class Event
{
    private $connection;
    private $table = 'events';

    public $id;
    public $time;
    public $details;
    public $team_home_fk;
    public $team_away_fk;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function list()
    {
        $query = 'SELECT 
            e.id,
            e.time,
            e.details,
            ta.name as away_team,
            th.name as home_team,
            s.name as sport
            FROM
                ' . $this->table . ' e
            LEFT JOIN
                teams ta ON e.team_away_fk = ta.id
            LEFT JOIN
                teams th ON e.team_home_fk = th.id
            LEFT JOIN
                sports s ON th.sport_fk = s.id
            ORDER BY
                e.time DESC';

        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement;
    }

    public function create()
    {
        $query = 'INSERT INTO
                        ' . $this->table . '
                    SET
                        time = :time, 
                        details = :details, 
                        team_home_fk = :team_home_fk, 
                        team_away_fk = :team_away_fk;';

        $statement = $this->connection->prepare($query);

        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->details = htmlspecialchars(strip_tags($this->details));
        $this->team_home_fk = htmlspecialchars(strip_tags($this->team_home_fk));
        $this->team_away_fk = htmlspecialchars(strip_tags($this->team_away_fk));

        $statement->bindParam(":time", $this->time);
        $statement->bindParam(":details", $this->details);
        $statement->bindParam(":team_home_fk", $this->team_home_fk);
        $statement->bindParam(":team_away_fk", $this->team_away_fk);

        $statement->execute();

        return $statement;
    }

    public function delete()
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $statement = $this->connection->prepare($sql);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $statement->bindParam(1, $this->id);

        if ($statement->execute()) {
            return true;
        }
        return false;
    }
}
