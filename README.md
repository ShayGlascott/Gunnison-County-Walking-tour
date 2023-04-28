# Gunnison Historical Walking Tour Website

One Paragraph of project description goes here

## Getting Started

### Prerequisites

Install docker

### Installing

Clone the repository

```
git clone https://github.com/CampbellZach/CS_495.git
```

or download the latest [release](https://github.com/CampbellZach/CS_495/releases/).

Change into the project directory

```
cd CS_495
```

Change permissions of pictures and mapMaterials folder (Required to upload pictures using the admin page)

```
chmod 777 www/html/pictures/
```

Build the Docker images

```
docker-compose build
```

Start the Docker containers

```
docker-compose up -d
```

Database initialization (required after building the containers to create the tables in the database)

```
docker exec mysql-container sh -c 'mysql -uroot -p"secret" "tourdb" < /docker-entrypoint-initdb.d/init.sql'
```

Check status of Docker containers

```
docker ps -a
```

## Using the website

* The website is hosted at `localhost` on port `80`.  
* Navigate to [main page](http://localhost/index.php) to visit the site locally.  
* Add/delete/edit tour stops and edit other pages using the [admin page](http://localhost/login.php), the username is **admin** and the password is **gwt23**.
* Navigate to a tour site and copy the url (eg. `http://example.com/tour.php?id=2`) and use it to generate a QR code.
* *Docker info ...*

## Authors

