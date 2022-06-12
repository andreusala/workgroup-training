# workgroup-training
Exercises to practise

## andreusala/workgroup-training
This repository stores some exercises that I do in workgroup to train.

## Index
* [How setup it](#markdown-header-how-setup-it)
* [How to test](#markdown-header-how-to-test)

## How setup it

### Requirements
* docker-compose version => 1.17.1
* docker version => 20.10.17

Check out your uid and gid of current user and edit `docker-compose.yml` file according to these two arguments, ignore it if it is: 1001
* C_UID: ${C_UID-1001}
* C_GID: ${C_GID-1001}

Run and build the application using docker image prepared for it:
```
docker-compose up -d
```

Once it's done, install all needed packages using composer installed:
```
docker exec -it workgrouptraining_phpfpm_1 composer install
```

## How to test

It has a test suite in order to coverage code written in src directory, you can run them just by:
```
docker exec -it workgrouptraining_phpfpm_1 vendor/bin/phpunit -c phpunit.xml
```