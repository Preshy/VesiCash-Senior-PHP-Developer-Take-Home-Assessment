# VesiCash (Senior PHP Developer Take Home Assessment ) 
![](https://img.shields.io/badge/version-0.1--beta-green.svg)
![](https://img.shields.io/badge/docker--compose-build-blue.svg)
![](https://img.shields.io/badge/docker-build-blue.svg)

##Description

RESTful API built with Laravel Lumen & PostgreSQL on Docker

## Let's go
#### Development environment
**- require**
    
    Docker version 18.09.6, build 481bc77
    docker-compose version 1.24.0, build 0aa59064

**- setup and run**

    0. Clone repository 

    1. Create .env file and copy contents of .env.example to it
       Command: cp .env.example .env
    
    2. Run
        docker-compose build
        docker-compose up
        docker exec php_container_name php artisan migrate
        docker exec php_container_name php artisan db:seed
        
        Lumen will be on http://127.0.0.1:8080
        
        To run artisan commands: docker exec php_container_name php artisan command
        
        Note: php_container_name refers to the container name created for you, find it in docker-compose.yml
        
    3. Test
        Using Postman:
         1. CREATE [POST]
            Send a POST request to http://127.0.0.1/escrow/transaction/create
            with JSON body as follows:
            {
            	"sender_email"		: "johqn@vesicash.com",
            	"sender_phone"		: "2348100000000",
            	"recipient_email"	: "mary@vesicash.com",
            	"recipient_phone"   : "2347000000000",
            	
            	"title"				: "iPhone X Purchase",
            	"description"		: "Purchase of iPhone X from John",
            	"price"				: 300000
            }
            
            You will either receive a 400 status code with the error message (validation) in the response body or a 200 status code with a success message.
            
          2. EDIT [PUT]
             Send a PUT request to http://127.0.0.1/escrow/transaction/edit
                      with JSON body as follows:
                      {
                        "id"                : 1
                      	"sender_email"		: "johqn@vesicash.com",
                      	"sender_phone"		: "2348100000000",
                      	"recipient_email"	: "mary@vesicash.com",
                      	"recipient_phone"   : "2347000000000",
                      	
                      	"title"				: "iPhone XR Purchase",
                      	"description"		: "Purchase of iPhone XR from John",
                      	"price"				: 300000
                      }
                      
                      You will either receive a 400 status code with the error message (validation) in the response body or a 200 status code with a success message. 
                      
          3. DELETE  
             Send a DELETE request to http://127.0.0.1/escrow/transaction/edit
            with JSON body as follows:
            {
              "id" : 1
            }
                                
          You will either receive a 400 status code with the error message (validation) in the response body or a 200 status code with a success message. 
          
           Using PHPUnit Tests:
              1. CREATE
                docker exec container_name vendor/bin/phpunit --filter=testShouldCreateEscrowTransaction
                
              2. EDIT
                docker exec container_name vendor/bin/phpunit --filter=testShouldEditEscrowTransaction
                
              3. DELETE
              docker exec container_name vendor/bin/phpunit --filter=testShouldDeleteEscrowTransaction
              
              Example response: 
              
              PHPUnit 7.5.14 by Sebastian Bergmann and contributors.
              
              .  1 / 1 (100%)
              
              Time: 3.06 seconds, Memory: 12.00 MB
              
              OK (1 test, 1 assertion)
## Info
Web server is on 127.0.0.1:8080 <br>
PostgreSQL is on host.docker.internal:8084

Lumen response time exceeding 100ms
After due research it looks like the following line: header('HTTP/1.0 200 OK1200'); in Symfony\Component\HttpFoundation is causing the extra 250ms. So I guess its not related to lumen
                 

## License

This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
