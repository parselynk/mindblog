This project is a simple blog andassignment which is done utilizing Laravel and TDD development.

the system consists of 2 databases, a SQLite in memory database for testing purpose and a MySql as main db.

==== to setup db ====

create a database with name of mindblog in your testing environment and then run following command

php artisan migrate 

==== to insert dummy data ====

to create 50 articles run following command 
php artisan db:seed --class ArticlesTableDataSeeder

note that laravel UserFactory is still available in this system.

========= system structure ===========

this system consists of 2 panels: public and admin.

- admin panel: includs articles list, individual article show, edit and create pages.
- public panel: is only for guest users and only includes articles list and show.


for accessing admin panel user needs to register as a member.


============== how to use system ============

- /admin/articles : shows list of articles - 15 per page - clicking on article title redirects user to the particular article page

- /admin/articles/{article}: shows individual article 
	- (only) if admin is the author of article will be able to delete or modify the article
	- admins are still able to see other outhers articles

- /admin/articles/create: admin can create a new article using this page 
	- title & content fileds are required
	- file input only accepts jpg images with dimension from 250-2048px adn max size of 1024
	- tags input utilizes jquery to be more intuitive for users to user

- /admin/articles/{article}/edit: users are able to modify articles using this page 
	- file upload is only available if there is no picture attached to the article otherwise the field will be hidden

============ tests =====================

most of the features of the system are tested.

================= UI ===================

this is system is designed using tailwindcss css framework as my first experience using this framework.




