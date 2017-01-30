# Base Web App - Framework free PHP web app

This is intended to be a ready to use web app base, making use of third party composer packages and minimal code to wire them together.

* Bring up Vagrant box with `vagrant up` (Currently uses Ubuntu 12.04 LTS with PHP 5.6 and Nginx)
* Install [Composer](https://getcomposer.org/) packages with `composer install`
* Create controllers in */src/Gez/Controller*
* Configure routing in */src/Gez/Routing.php* ([league/route](http://route.thephpleague.com/))
* Create views in */views* ([league/plates](http://platesphp.com/))
* Create Repository classes in */src/Gez/Repository* ([Doctrine DBAL](http://www.doctrine-project.org/projects/dbal.html))
* Configure container services in */src/Gez/Container/Services.php* ([league/container](http://container.thephpleague.com/) with auto-wiring enabled)
* Make use of [PSR-7 Messages](http://www.php-fig.org/psr/psr-7/) ([Zend Diactoros](https://zendframework.github.io/zend-diactoros/))
* Add PSR-7 compliant middlewares in */src/Gez/Core/Http/Middleware* ([Relay](http://relayphp.com/))
* Log file in */app/log/app.log* ([Monolog](https://github.com/Seldaek/monolog))
* Add Bower packages in */web* ([Bootstrap](http://getbootstrap.com/) & [jQuery](https://jquery.com/) preinstalled)
* Detailed error pages ([Whoops](http://filp.github.io/whoops/))
* Debug with calls to d() ([Kint](http://raveren.github.io/kint/))
* Analyse app in development with DebugBar ([DebugBar](https://github.com/maximebf/php-debugbar))

# Todo

* Create Ubuntu 16.04 LTS / PHP 7.x alternate Vagrant box
* Maybe preinstall asset pipeline; Webpack or Gulp
* Maybe integrate an ORM (Doctrine?)
* Maybe integrate a Mongo ODM layer
