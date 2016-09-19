# Phalcon 3 API Quick Start for Docker

Phalcon is a web framework for PHP delivered as a C extension providing high performance and lower resource consumption.

This is a simple quick start application for building a REST API with Phalcon 3 using Docker.

## Get Started

### Requirements

To run this application on your machine, you need at least:

* [Docker](https://www.docker.com/products/overview#/install_the_platform) >= 1.12

### Starting Docker Containers

#### Run a MySQL Container

```$ docker run -e MYSQL_ROOT_PASSWORD=password -d mysql:latest```

Connect to the database and import the [schema.sql](schema.sql) file.  This can be done by connecting to the container directly or through a MySQL administrative tool.

See Docker [exec](https://docs.docker.com/engine/reference/commandline/exec/) for more information on connecting to running containers.

You can obtain information about the MySQL container, such as the IP address, with the Docker [inspect](https://docs.docker.com/engine/reference/commandline/inspect/) command.

#### Run the Phalcon Quick Start Container

Review and edit the [Dockerfile](Dockerfile) to ensure you have all of the required software packages to build and run your own application.

Optionally, configure the container by reviewing and updating the [run.sh](run.sh) script.

Run the container

```$ ./run.sh```

### The API

#### Configuration

Review and update the [application](application/config/application.php) and [database](application/config/database.php) configuration files

#### Testing

```
$ php client.php
GET Result 
{
    "success": true
}
POST Result 
{
    "success": true,
    "data": {
        "test": "sample content"
    }
}
```
