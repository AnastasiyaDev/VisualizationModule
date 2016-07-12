Visualization module
=========

The technology used in the project: HTML5/CSS3, LESS, JavaScript, jQuery, Highcharts, PHP, Symfony framework, Twig, MySQL.<br>

Task: the creation of experiments, tables, benchmarks, filling two-dimensional data tables and visualization of the data.<br>

For the run of project:<br>

> composer update

use all the default database settings, except for:<br>

>database_name: symfony

create user and database. For creating tables on database:<br>

> php app/console doctrine:schema:update --force 

run PHP-server in directory of project:<br>

>php app/console server:run