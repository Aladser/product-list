<?php

exec('cd /var/www/product-list && php artisan queue:work');
