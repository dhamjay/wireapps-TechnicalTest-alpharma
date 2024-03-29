# REST API on Laravel 9.0 for Alpharma Pharmacy

## Description

A pharmacy, along with its stakeholders, including the owner, manager, and cashier, requires a
system to streamline its business processes, involving authentication, medication inventory
management, and customer record management. The system needs to enforce user roles and
permissions for different actions.

The solution is built using Laravel 9.0.     
The users can be grouped into three main groups acording to the operations they can perform on the system. 

*** It uses Laravel-contributed packages such as Laravel Passport and Spatie to manage users, user roles, and permission management.

* User login and authentication/guard are handled by Laravel Passport.   
* User roles and access/permission control are managed using Spatie.     
* Request authorization is handled using Laravel's Gates.

## Installation

### Prerequisites

- PHP 8.0
- Laravel 9.0
- Composer 2.5
- SQLite Driver

### Setup

1. Clone the project repository   
`git clone https://github.com/dhamjay/wireapps-TechnicalTest-alpharma.git`

2. Install Composer Dependencies (if needed)     
`composer install`     

3. edit `.env` file if needed.    

4. Run Migrations and Seeders:    
`php artisan migrate`     
`php artisan db:seed`   

5. Install passport     
`php artisan passport:install`

6. Serve    
`php artisan serve`

7. Import `alpharma.postman_collection.json` to Postman to test.

8. First register a user by posting to   
`http://127.0.0.1:8000/api/register `

required form-data,    
username    
name    
email     
password    

***Note:- make sure to copy the user's access token from the response after successful registering,  for future use***

### Dependencies

List any additional dependencies or external libraries that are required to run the project.

`composer require spatie/laravel-permission`

`composer require laravelcollective/html`

`composer require laravel/passport`

Run this command to create permission control service and permission control migration

`php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"`


## SQLite database
Entity-Relationship (ER) diagram can be found here.

`/alpha.sqlite`

## Database Schema and Models

Entity-Relationship (ER) diagram can be found here. [link](https://github.com/dhamjay/wireapps-TechnicalTest-alpharma/blob/main/erd.png)     

`/erd.png`

An ER diagram could be generated inside Laravel using package "beyondcode/laravel-er-diagram-generator".It uses models and relations defined in the code and graph generated by this is can be seen here. [link](https://github.com/dhamjay/wireapps-TechnicalTest-alpharma/blob/main/graph.png)    

`/graph.png`

#### Main Models
- User   
- Customer    
- Medication    
- PurchaseOrder    

#### Support Models
- Role    
- Permission    

## Postman collection

Respective endpoints for API testing can be found here. [link](https://github.com/dhamjay/wireapps-TechnicalTest-alpharma/blob/main/alpharma.postman_collection.json)    
`/alpharma.postman_collection.json`

Note- The access tokens are also included and please change asrequired.

### Summary of API routes

>    
POST :: /login   
POST :: /logout    
POST :: /register   

(CRUD 'customers')    
GET :: /customers    
GET :: /customers/{id}    
POST :: /customers    
PUT :: /customers/{id}    
DELETE :: /customers/{id}    
GET :: /customers/{id}/restore    
GET :: /customers/{id}/force-delete    

(CRUD 'medications')    
GET :: /medications    
GET :: /medications/{id}    
POST :: /medications    
PUT :: /medications/{id}    
DELETE :: /medications/{id}    
GET :: /medications/{id}/restore    
GET :: /medications/{id}/force-delete    


#### Permission assigned to each role

Guard: api    
admin -      
-- view, create, delete, edit, publish,    
cashier -     
-- view, ------, ------, edit, -------,    
manager -      
-- view, ------, ------, edit, publish,    
owner -      
-- view, create, delete, edit, publish,     
