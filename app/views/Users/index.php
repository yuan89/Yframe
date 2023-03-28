<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<h1>user</h1>

<table>
    <tr>
        <th>ID</th>
        <td><?php echo htmlspecialchars($id); ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo htmlspecialchars($name); ?></td>
    </tr>
    <tr>
        <th>Age</th>
        <td><?php echo htmlspecialchars($age); ?></td>
    </tr>
</table>

</body>
</html>



