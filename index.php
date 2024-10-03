<?php
include('includes/config.php');
$conn = connect_db();

// Get all adjectives
$query = "SELECT * FROM adjetivos";
$result = $conn->query($query);
$adjectives = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $adjectives[] = $row;
    }
}

// Process search
$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM adjetivos WHERE adjetivo LIKE '%$search%'";
    $result = $conn->query($query);
    $adjectives = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $adjectives[] = $row;
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adjectives in Spanish</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(to right, #eef2f3, #ffffff);
        margin: 0;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h1 {
        text-align: center;
        color: #343a40;
        margin-bottom: 20px;
        font-size: 2.5rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #495057;
        margin-top: 40px;
        font-size: 2rem;
    }

    form {
        text-align: center;
        margin-bottom: 20px;
        animation: fadeIn 0.5s;
    }

    input[type="text"] {
        padding: 12px;
        width: 350px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s, box-shadow 0.3s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    input[type="text"]:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
    }

    button {
        padding: 12px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        margin-left: 10px;
        transition: background-color 0.3s, transform 0.3s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    button:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    td {
        color: #495057;
    }

    a {
        display: inline-block;
        margin: 5px;
        padding: 10px 15px;
        text-decoration: none;
        color: white;
        background-color: #28a745;
        border-radius: 6px;
        transition: background-color 0.3s, transform 0.3s;
    }

    a:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }

    .button-container {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    footer {
        text-align: center;
        margin-top: 40px;
        font-size: 14px;
        color: #6c757d;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

</head>
<body>
    <h1>Adjectives in Spanish</h1>

    <form method="POST">
        <input type="text" name="search" placeholder="Search adjective" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>

    <h2>List of Adjectives</h2>
    <table>
        <thead>
            <tr>
                <th>Adjective</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($adjectives as $adjective): ?>
                <tr>
                    <td><?php echo htmlspecialchars($adjective['adjetivo']); ?></td>
                    <td class="button-container">
                        <a href="ejemplos.php?id=<?php echo $adjective['id']; ?>">View examples</a>
                        <a href="index.html">POWER COMPARE</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <footer>
        &copy; <?php echo date("Y"); ?> Adjectives Database. All rights reserved.
    </footer>
</body>
</html>

