<?php
require_once dirname(__FILE__) . "/vendor/autoload.php";


$task = $_GET['task'];
$user_id = 69;

if ($task == 'alter') {
    $id_to_change = $_GET['box'];
    $status = $_GET['setto'];

    require "connect.php";
    $db->database('todo');

    $db->write(
        "
            ALTER TABLE Tasks
            UPDATE Status = {status}
            WHERE Id = '{id}'
        ",
        [
            'status' => $status,
            'id' => $id_to_change
        ]
    );
}

if ($task == 'add') {
    $title = $_GET['toadd'];

    require "connect.php";
    $db->database('todo');

    $uuid = $db->select('SELECT generateUUIDv4() AS UUIDv4')->fetchOne()['UUIDv4'];
    $date = $db->select('SELECT now() AS date')->fetchOne()['date'];

    $adding_info = $db->insert('Tasks',
        [
            [ 
                $uuid,                           // 1
                $title,                          // 2
                0,                               // 3
                $user_id,                        // 4
                $date                            // 5
            ],
        ],
        [
            'Id',                                // 1
            'Title',                             // 2
            'Status',                            // 3
            'UserId',                            // 4
            'DateAdded'                          // 5
        ]
    );
}

if ($task == 'delete') {
    $idtoremove = $_GET['toremove'];

    require "connect.php";
    $db->database('todo');

    $removeing_task = $db->write(
        "
            ALTER TABLE Tasks DELETE WHERE Id = '{id}'
        ",
        ['id' => $idtoremove]
    );

}
php?>
    <script>
        window.location = "http://3.138.123.188/";
    </script>
