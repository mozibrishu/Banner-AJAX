<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <style>
        h1 {
            font-size: 30px;
            text-align: center;
            color: #495C83;
        }

        table {
            border-collapse: collapse;
            width: 95%;
            margin: 0 auto;
        }

        td,
        th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: tomato;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php
    class SQLiteDB extends SQLite3
    {
        function __construct()
        {
            $this->open('information.sqlite');
        }
    }
    $db = new SQLiteDB();
    if (!$db) {
        echo $db->lastErrorMsg();
    }
    echo "<h1>User Information</h1>
<table>
    <tr>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>MOBILE</th>
        <th>DIVISION</th>
      </tr>";
    $ret = $db->query('SELECT * FROM peoplesInfo');
    while ($row = $ret->fetchArray()) {
        echo "<tr>
        <td>{$row['NAME']}</td>
        <td>{$row['EMAIL']}</td>
        <td>{$row['MOBILE']}</td>
        <td>{$row['DIVISION']}</td>
      </tr>";
    }
    echo "</table>";


    $db->close();
    ?>
</body>

</html>