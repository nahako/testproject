<?php

class Main_Database
{
    private $servername = "localhost";
    private $username = "nahako_cronjob";
    private $password = "T66jDAS*";
    private $database = "nahako_cronjob";
    private $connection;

    function __construct()
    {
        $this->connection = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
        mysqli_options($this->connection, MYSQLI_OPT_LOCAL_INFILE, true);

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $this->check_database();
    }

    private function check_database()
    {
        $queryCreateUsersTable = "CREATE TABLE IF NOT EXISTS `products` (
            `ID` int(11) unsigned NOT NULL auto_increment,
            `title` varchar(255) NOT NULL default '',
            `price` varchar(255) NOT NULL default '',
            `doc_id` int(11) UNIQUE NOT NULL,
            PRIMARY KEY  (`ID`)
        )";
        if (!$this->connection->query($queryCreateUsersTable)) {
            die("Table creation failed . {$this->connection->error}");
        }
    }

    public function importData($csv = '')
    {
        if (!file_exists($csv)) {
            return 'File not exists';
        }
        $query = '
         LOAD DATA LOCAL INFILE "' . $csv . '" IGNORE 
         INTO TABLE products 
         FIELDS TERMINATED BY "," 
         LINES TERMINATED BY "\r\n" 
         IGNORE 1 LINES 
         (@column1,@column2,@column3) 
         SET title = @column2, price = @column3,  doc_id = @column1
         ';
        $result = $this->connection->query($query);

        if (!$result) {
            error_log("File import failed. {$this->connection->error}");
        }
        return $result ? true : $this->connection->error;
    }

    public function add_item($id, $title, $price)
    {
        if ($this->item_exists($id)) {
            $this->update_item($id, $title, $price);
        } else {
            $this->create_item($id, $title, $price);
        }
    }

    private function item_exists($id)
    {
        $sql = "SELECT * FROM products WHERE `doc_id` = '{$id}'";
        $result = $this->connection->query($sql);
        return $result->num_rows > 0;
    }

    private function update_item($id, $title, $price)
    {
        $sql = "UPDATE products SET title='{$title}', price='{$price}' WHERE doc_id='{$id}'";
        $result = $this->connection->query($sql);
        if (!$result) {
            error_log("Failed to update product #{$id}");
        }
    }

    private function create_item($id, $title, $price)
    {
        $sql = "INSERT INTO products (title, price, doc_id) VALUES ('{$title}', '{$price}', '{$id}')";
        $result = $this->connection->query($sql);
        if (!$result) {
            error_log("Failed to create product #{$id}");
        }
    }
}