<?php include 'navbar.php'; ?>
<?php
require_once 'db_connection.php';

// Count lost items
$lostCountQuery = "SELECT COUNT(*) AS count FROM Lost_Item";
$lostCountResult = $conn->query($lostCountQuery);
$lostCount = $lostCountResult->fetch_assoc()['count'];

// Count found items
$foundCountQuery = "SELECT COUNT(*) AS count FROM Found_Item";
$foundCountResult = $conn->query($foundCountQuery);
$foundCount = $foundCountResult->fetch_assoc()['count'];

// Count claimed items
$claimedCountQuery = "SELECT COUNT(*) AS count FROM Claim";
$claimedCountResult = $conn->query($claimedCountQuery);
$claimedCount = $claimedCountResult->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 60px;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #333;
            margin-top: 20px;
        }
        .statistics, .actions {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            width: 80%;
            max-width: 600px;
        }
        .statistics h3, .actions h3 {
            color: #555;
            margin-bottom: 10px;
        }
        .statistics ul {
            list-style: none;
            padding: 0;
        }
        .statistics li {
            background-color: #e9e9e9;
            border-radius: 4px;
            margin: 5px 0;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .statistics li i {
            color: #007BFF;
        }
        .actions a {
            display: block;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            margin: 10px 0;
            transition: background-color 0.3s;
        }
        .actions a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Lost and Found Management</h1>
    <div class="statistics">
        <h3>Statistics</h3>
        <ul>
            <li><span>Lost Items:</span> <span><?php echo $lostCount; ?> <i class="fas fa-search"></i></span></li>
            <li><span>Found Items:</span> <span><?php echo $foundCount; ?> <i class="fas fa-box-open"></i></span></li>
            <li><span>Claimed Items:</span> <span><?php echo $claimedCount; ?> <i class="fas fa-hand-holding"></i></span></li>
        </ul>
    </div>
    <div class="actions">
        <h3>Actions</h3>
        <a href="report_lost.php"><i class="fas fa-exclamation-circle"></i> Report Lost Item</a>
        <a href="report_found.php"><i class="fas fa-check-circle"></i> Report Found Item</a>
        <a href="view_items.php"><i class="fas fa-eye"></i> View Items</a>
    </div>
</body>
</html>
