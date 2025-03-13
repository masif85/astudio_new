# Project Name

## Introduction


## Requirements
- PHP 8.2
- Composer
- Laravel 12
- MySQL


## Installation
Install Passport Package, Migrate Database with Seed

#Github Repo
https://github.com/masif85/astudio_new

# API Documentation

## Auth Routes
- Register http://127.0.01:8000/api/register POST 
- Login http://127.0.01:8000/api/login POST
- Logout http://127.0.01:8000/api/logout GET

## Project Model
- All User Projects http://127.0.01:8000/api/project GET
- Create Project http://127.0.01:8000/api/project POST
- Show http://127.0.01:8000/api/project/{project} GET
- Update http://127.0.01:8000/api/project/{project} PUT
- Delete http://127.0.01:8000/api/project/{project} DELETE
- Filter http://127.0.01:8000/api/projects?name=test&status=pending GET

## Time Sheet Model
- All http://127.0.01:8000/api/timesheet GET
- Create http://127.0.01:8000/api/timesheet POST
- Show http://127.0.01:8000/api/timesheet/{timesheet} GET
- Update http://127.0.01:8000/api/timesheet/{timesheet} PUT
- Delete http://127.0.01:8000/api/timesheet/{timesheet} DELETE

## Attribute Model
- All http://127.0.01:8000/api/attribute GET
- Create  http://127.0.01:8000/api/attribute POST
- Show http://127.0.01:8000/api/attribute/{attribute} GET
- Update http://127.0.01:8000/api/attribute/{attribute} PUT
- Delete  http://127.0.01:8000/api/attribute/{attribute} DELETE

## Attribute Values Model
- All http://127.0.01:8000/api/attribute_value GET
- Create http://127.0.01:8000/api/attribute_value POST
- Show http://127.0.01:8000/api/attribute_value/{attribute_valuye} GET
- Update http://127.0.01:8000/api/attribute_value/{attribute_value} PUT
- DELETE http://127.0.01:8000/api/attribute_value/{attribute_value} DELETE
