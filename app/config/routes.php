<?php
# ./app/config/routes.php

use App\Provider\GuestbookControllerProvider;

$app->mount('/api', new GuestbookControllerProvider());