First copy and paste the add-on folder in packages folder. After done the copy open terminal/command window and fire below command.

composer dump-autoload

For the migrate database table.
php artisan migrate --path=packages/textla/review/src/migrations

For the migrate database seed generation.
php artisan db:seed

When you fire above seeds command it will ask you question below questions 
1) Please enter addon name ? ans: REVIEW
2) Please enter admin menu name ? ans: Review Management

After complete setup go to application admin panel with  http://<yourwebsiteurl>/textla/login and login to admin panel and go to addon tab and activate the plugin.

