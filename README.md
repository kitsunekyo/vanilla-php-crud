# vanilla php crud example
Basic showcase, how a very crude crud (see what i did there 😁) app could look like. 
I'm not a php dev, so please don't use this as an example if possible.

## Usage

### api
Runs on PHP, uses MariaDb (default mysql pdo)

1. Create an .env file with the config details inside ./api/

```
// example .env
DB_NAME=sportradar
DB_USERNAME=sportradar
DB_PASSWORD=sportradar
DB_HOST=localhost
DB_PORT=3306
```

2. Create and seed the db via the `./db.sql` file.
3. Install composer dependencies

### client
Micro Vuejs app. As simple as it gets. Just statically serve the contents of `./client`.