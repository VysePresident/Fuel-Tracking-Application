<?php 

require_once __DIR__ . '/../src/client.php';

//require_once 'src/client.php'; //'D:\Github\Fuel-Tracking-Application\src\client.php';//'../src/client.php';

$clients = array(
    new Client('tom@example.com', 'Tom', 'Doe', '123-456-7890', 'password1', 'ACME Inc.', 'CA', 'San Francisco', '123 Main St'),
    new Client('jane@example.com', 'Jane', 'Doe', '456-789-0123', 'password2', 'Widgets LLC', 'NY', 'New York', '456 Broadway'),
    new Client('bob@example.com', 'Bob', 'Smith', '555-555-1212', 'password3', 'Furniture Co.', 'TX', 'Houston', '789 Elm St'),
    new Client('alice@example.com', 'Alice', 'Jones', '333-333-3333', 'password4', 'Consulting LLC', 'IL', 'Chicago', '321 State St'),
    new Client('sam@example.com', 'Sam', 'Wilson', '777-777-7777', 'password5', 'Tech Corp.', 'CA', 'Los Angeles', '456 Pine St')
);

/*use Client;

$clients = array (
  0 => new Client(
     'tom@example.com',
     'password1',
     'Tom',
     'Doe',
     '123-456-7890',
     'ACME Inc.',
     'CA',
     'San Francisco',
     '123 Main St'
  ),
  1 => new Client(
     'jane@example.com',
     'password2',
     'Jane',
     'Doe',
     '456-789-0123',
     'Widgets LLC',
     'NY',
     'New York',
     '456 Broadway'
  ),
  2 => new Client(
     'bob@example.com',
     'password3',
     'Bob',
     'Smith',
     '555-555-1212',
     'Furniture Co.',
     'TX',
     'Houston',
     '789 Elm St'
  ),
  3 => new Client(
     'alice@example.com',
     'password4',
     'Alice',
     'Jones',
     '333-333-3333',
     'Consulting LLC',
     'IL',
     'Chicago',
     '321 State St'
  ),
  4 => new Client(
     'sam@example.com',
     'password5',
     'Sam',
     'Wilson',
     '777-777-7777',
     'Tech Corp.',
     'CA',
     'Los Angeles',
     '456 Pine St'
  ),
);*/
