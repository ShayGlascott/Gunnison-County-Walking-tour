# Gunnison Historical Walking Tour
## Installation
### Clone the GitHub repository:  
```
# git clone https://github.com/CampbellZach/CS_495.git
```
or download the latest [release](https://github.com/CampbellZach/CS_495/releases/).

### Change into the project directory: 
```
cd CS_495
```
### Change permissions of pictures and mapMaterials folder:
(Required to upload pictures using the admin page)
```
# chmod 777 www/html/pictures/
# chmod 666 data/data.sqlite3
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
* The website is hosted on port `80`.  Navigate to `http://localhost` to view the site.  
* The [main page](http://localhost/index.php) has information about the tour.
* Add/delete/edit tour stops and edit other pages using the [admin page](http://localhost/login.php), the username is `admin` and the password is `gwt23`.
* Navigate to a tour site and copy the url (`http://example.com/tour.php?id=2`) and use it to generate a QR code.
