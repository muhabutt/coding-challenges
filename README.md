## Code test all answers are inside one project.

- git clone https://github.com/muhabutt/coding-challenges.git
- create a virtual host.
```
#localhost ip	for example 127.0.0.12 alen-code-test.com or what ever you want
<VirtualHost 127.0.0.12:80>
   DocumentRoot "E:/xampp-php-7.3/htdocs/code-tests/alen-code-test/questions/"
   DirectoryIndex index.php 
   <Directory "E:/xampp-php-7.3/htdocs/code-tests/alen-code-test/questions/">
       Options All
        AllowOverride All
        Order Allow,Deny
        Allow from all
    </Directory>
</VirtualHost>

thats it you dont need to do anything else. for laravel project do the following
cd inside questions\question1\laravel and run below command
e:questions\question1\laravel composer install
above command will instal laravel.

E:/xampp-php-7.3/htdocs/code-tests/alen-code-test/questions/index.php is a main file which points 
to all the questions.

```

- you will find folder structure as follows
    - questions
        - question1 
            - contains laravel project. run composer install inside question1/laravel folder
            you will get the required packages for laravel
            
        - question2
            - contains question 2 answer, i have used javascript for question 2
            
        - question3
            - contains question 3 answer i have used php
            
        - question4
            - contains question 4 answer i have used javascript
            
        - question5
            - contains question 5 answer . please run composer install inside question5 folder. i have used both javascript and php
