# Test Project

Edit your Database config in the Main_Database.php

```php
    private $servername = "localhost";
    private $username = "username";
    private $password = "password";
    private $database = "database";
```

Add script execution to run cron job every minute
````
* * * * * path/to/phpbin path/to/scheduler.php 1>> /dev/null 2>&1
````