<?php
include_once 'db/Database.php';
include_once 'model/Event.php';

class EventsController
{
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function create()
    {
        $item = new Event($this->connection);

        $data = json_decode(file_get_contents("php://input"));

        $item->time = $data->time;
        $item->details = $data->details;
        $item->team_home_fk = $data->team_home_fk;
        $item->team_away_fk = $data->team_away_fk;

        $statement = $item->create();
        $id = $this->connection->lastInsertId();

        // should get values for foreignkeys
        if ($statement) {
            echo json_encode(
                ["message" => "created event", "id" => $id]
            );
        } else {
            echo json_encode(
                ["message" => "error creating event"]
            );
        }
    }

    public function read()
    {
        $items = new Event($this->connection);

        $stmt = $items->list();
        $count = $stmt->rowCount();

        if ($count > 0) {

            $list = array();
            $list["data"] = array();
            $list["count"] = $count;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $e = [
                    'id' => $id,
                    'time' => $time,
                    'details' => $details,
                    'sport' => $sport,
                    'away_team' => $away_team,
                    'home_team' => $home_team
                ];

                array_push($list["data"], $e);
            }
            echo json_encode($list);
        } else {
            http_response_code(404);
            echo json_encode(
                ["message" => "No record found."]
            );
        }
    }

    public function delete()
    {
        $item = new Event($this->connection);
        $data = json_decode(file_get_contents("php://input"));

        $item->id = $data->id;

        if ($item->delete()) {
            echo json_encode('Event deleted');
        } else {
            echo json_encode('Error deleting Event');
        }
    }
}
