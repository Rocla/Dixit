# School Project of Web Development at HE-Arc Neuchâtel

[HTML5](http://www.w3.org/TR/html5/), [PHP](http://www.php.net), and [Laravel](http://laravel.com) adaptation of the Dixit card game.

## [Project live at: http://phanes.srvz-webapp.he-arc.ch](http://phanes.srvz-webapp.he-arc.ch)


## Brief Description

- It's a PRIVATE project (nobody has access to it expect people involved!!), plus this is a school project, and has for goal to learn the framework Laravel 5.
- In our case we took an existing project [Dixit-Online](https://github.com/PCreations/Dixit-Online) (which is PUBLICLY availibale on github, but without licence, meaning it's under copyright), and we will be insired by it to make the logic and and using the artworks of the game to conscentrate on the Framework [Laravel](http://laravel.com).
- Also note that the project [Dixit-Online](https://github.com/PCreations/Dixit-Online) is already under copyright infringement! Because it's a numerical version of a game under copyright, and it's using its artworks which are also under copyright!
- So, this project is cleary doing copyright infringement! We are conscious of that!
 - But, again, it's a school project, and its goal is to learn and practice the [Laravel](http://laravel.com) framework!

## [More on the Wiki](https://github.com/Rocla/Dixit/wiki)

## License

- Copyright to the logic: [Dixit-Online](https://github.com/PCreations/Dixit-Online)
- Copyright for the game and the artwork: [Libellud](http://en.libellud.com/games/dixit)


## Setup the project

### Setup tested on nginx server:
 > git clone https://github.com/Rocla/Dixit.git<br>
 > sudo rsync -a --progress Dixit/ www/<br>
 > cd www<br>
 > composer install

 - Set the .env file

> sudo chmod -R o+w storage<br>
> composer dump-autoload<br>
> composer update --no-scripts<br> 
> composer update<br> 
> php artisan vendor:publish<br>
> php artisan cache:clear<br>
> php artisan config:cache<br>
> php artisan migrate:install<br>
> php artisan migrate<br>
> php artisan db:seed<br>

### Setup tested locally
- Create a new larvael project in a tmp folder
 > composer create-project laravel/laravel --prefer-dist

- Configure the namespace
 > php artisan app:name Dixit

- Cut/Copy and Paste the whole content of the clone of this repertory and fuse the folders

- Set the new path of this git repertory to the fused folder just made

- Create the .env file, an exemple file is provided (you have to provide the database information)

- open the terminal at the root folder and do the following commands:

 > sudo chmod -R o+w storage<br>
 > composer dump-autoload<br>
 > composer update --no-scripts<br> 
 > composer update<br> 
 > php artisan vendor:publish<br>
 > php artisan cache:clear<br>
 > php artisan config:cache<br>
 > php artisan migrate:install<br>
 > php artisan migrate<br>
 > php artisan db:seed<br>


### Example of .env

> APP_ENV=local<br>
> APP_DEBUG=true<br>
> APP_KEY=SomeRandomString<br>

> DB_HOST=localhost<br>
> DB_DATABASE=homestead<br>
> DB_USERNAME=homestead<br>
> DB_PASSWORD=secret<br>

> CACHE_DRIVER=file<br>
> SESSION_DRIVER=file<br>
> QUEUE_DRIVER=sync<br>

> MAIL_DRIVER=smtp<br>
> MAIL_HOST=mailtrap.io<br>
> MAIL_PORT=2525<br>
> MAIL_USERNAME=null<br>
> MAIL_PASSWORD=null<br>
> MAIL_ENCRYPTION=null<br>


## DISMISSED 

 > cd game_server<br>
 > npm install

Configuration of the sub-domain for the game server:
- Create the sub-domain "activity" for example activity.dixit.com
- Add the following to the virtualhost settings of this sub-domain

 > ProxyPass / http://dixit:3000/<br>
 > ProxyPassReverse / http://dixit:3000/

### Run the game server
- Go to root directory of the application "/Dixit"
> sh run.sh&<br>

