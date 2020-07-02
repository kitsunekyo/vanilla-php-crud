# vanilla php crud example
Basic showcase, what a very crude crud app could in php look like. 
I'm not a php dev, so please don't take this too seriously. + Last time i've touched vue was q1 2019.

> Note: express + NoSQL is a lot faster for setting up things like that

![screenshot](screenshot.png)

## Usage
Run `docker-compose up -d`. Frontend is available on `localhost:3000`, Api on `localhost:8080`.

### api
Runs on PHP, uses mysql.

Implemented Route for events: `/events.php`. (GET, POST, DELETE)

### client
Micro Vuejs app. As simple as it gets. Just statically serve the contents of `./client`.

> I've named the foreign keys with a postfix `_fk` instead of prefixing with `_`. Habit, and dont want to bother replacing all instances for the example code.