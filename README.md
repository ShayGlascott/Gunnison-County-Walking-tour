## Necessary fixes:
* Change database accesses to use [PDO](https://www.php.net/manual/en/book.pdo.php)
* [Example of PDO used to access a database](examples/index.php)
* Make instructions for using admin page and generating qr codes

## Directory structure
```
├── docker-compose.yaml
├── content
│   ├── ...
│   └── tourdb.sql
├── examples
│   └── index.php
├── nginx
│   ├── default.conf
│   └── Dockerfile
├── php
│   └── Dockerfile
└── www
    └── html
        ├── pictures
        ├── tinymce
        ├── database.php
        ├── index.php
        └── ...




```

# Gunnison Historical Walking Tour
## Installation
### Clone the GitHub repository:  
```
# git clone https://github.com/CampbellZach/CS_495.git
```
### Change into the project directory:  
```
# cd CS_495
```
### Add user to docker group (optional):
```
# usermod -aG docker your-user
```
### Build the Docker images:  
```
# docker-compose build
```
### Start the Docker containers:  
```
# docker-compose up -d
```
### Check status of Docker containers:  
```
# docker ps -a
```
## Using the website
* Admin Page  
* QR Codes
