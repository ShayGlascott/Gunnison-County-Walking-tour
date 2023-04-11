# Gunnison Historical Walking Tour
## Installation
### Clone the GitHub repository:  
```
# git clone https://github.com/CampbellZach/CS_495.git
```
or download a release: [release-1.0](https://github.com/CampbellZach/CS_495/releases/tag/v1.0)

### Change into the project directory: 
```
cd CS_495
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
* The website is hosted on port `80`.  Navigate to `http://localhost` to view the site.  
* The [main page](http://localhost/index.php) has information about the tour.
* Add/delete/edit tour stops using the [admin page](http://localhost/login.php), the username is `admin` and the password is `gwt23`.
* Navigate to a tour site and copy the url (`http://example.com/tour.php?id=2`) and use it to generate a QR code.
