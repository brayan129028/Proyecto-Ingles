<?php
include '../includes/config.php';
$conn = connect_db();

$id = $_GET['id'] ?? null;
$examples = [
    'positivo' => [],
    'comparativo' => [],
    'superlativo' => []
];

if ($id) {
    $query = "SELECT * FROM ejemplos WHERE id_adjetivo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $examples[$row['forma']][] = $row['ejemplo'];
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
    <title>Examples of the Adjective</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(to right, #f4f4f4, #ffffff);
        margin: 0;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h1 {
        text-align: center;
        color: #333;
        font-size: 2.5rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #007bff;
        margin-top: 20px;
        font-size: 1.8rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    ul {
        list-style-type: none;
        padding: 0;
        width: 100%;
        max-width: 600px;
    }

    li {
        background: white;
        margin: 10px 0;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, transform 0.3s;
    }

    li:hover {
        background-color: #e9ecef;
        transform: translateY(-2px);
    }

    a {
        display: inline-block;
        margin: 20px auto;
        padding: 12px 20px;
        text-decoration: none;
        color: white;
        background-color: #28a745;
        border-radius: 8px;
        text-align: center;
        font-size: 16px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, transform 0.3s;
    }

    a:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }
</style>

</head>
<body>
    <h1>Examples of the Adjective</h1>

    <?php if (!empty($examples['positive']) || !empty($examples['comparative']) || !empty($examples['superlative'])): ?>
        <h2>Positive</h2>
        <ul>
            <?php foreach ($examples['positive'] as $example): ?>
                <li><?php echo htmlspecialchars($example); ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Comparative</h2>
        <ul>
            <?php foreach ($examples['comparative'] as $example): ?>
                <li><?php echo htmlspecialchars($example); ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Superlative</h2>
        <ul>
            <?php foreach ($examples['superlative'] as $example): ?>
                <li><?php echo htmlspecialchars($example); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No examples available for this adjective.</p>
    <?php endif; ?>

    <a href="index.php">Back to the list of adjectives</a>
</body>
</html>
