<!-- display all users -->
<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/get_users.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>View Users</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            border: 1px solid #ED7020;
            text-align: left;
        }

        table th {
            background-color: #ED7020;
            color: white;
            
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table td {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="form_wrapper">
        <h1>View Users</h1>
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
            <?php
            $users = get_users();


            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['username'] . "</td>";
                echo "<td>" . $user['email'] . "</td>";
                // specify roles for users depending on the value of isAdmin

                echo "<td>" .  ($user['isAdmin'] == 1 ? 'Admin' : 'User') . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>