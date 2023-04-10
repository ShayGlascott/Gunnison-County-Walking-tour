#!/bin/bash

# Clone repo
git clone https://github.com/CampbellZach/CS_495.git
cd CS_495

# Docker
docker-compose build
docker-compose up -d
