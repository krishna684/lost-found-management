<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Items</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    </style>
</head>
<body class="bg-gray-100">
    <?php include 'navbar.php'; ?>
    <div class="container mx-auto p-4" style="margin:100px">
        <!-- Lost Items Section -->
        <h2 class="text-2xl font-bold mb-4">Lost Items</h2>
        <ul class="bg-white p-6 rounded shadow-md mb-8">
        <?php
        $result = $conn->query(
            "SELECT li.Description, li.Date_Lost, u.First_Name, u.Last_Name, uc.Contact_Info 
             FROM Lost_Item li
             JOIN User u ON li.User_ID = u.User_ID
             JOIN User_Contact uc ON u.User_ID = uc.User_ID"
        );
        while ($row = $result->fetch_assoc()) {
            echo "<li class='mb-4 p-4 border-b'>
                <p><strong>Description:</strong> {$row['Description']}</p>
                <p><strong>Date Lost:</strong> {$row['Date_Lost']}</p>
                <p><strong>Reported by:</strong> {$row['First_Name']} {$row['Last_Name']}</p>
                <p><strong>Contact Info:</strong> {$row['Contact_Info']}</p>
            </li>";
        }
        ?>
        </ul>

        <!-- Found Items Section -->
        <h2 class="text-2xl font-bold mb-4">Found Items</h2>
        <ul class="bg-white p-6 rounded shadow-md">
        <?php
        $result = $conn->query(
            "SELECT fi.Item_ID, fi.Description, fi.Date_Found, u.First_Name, u.Last_Name, uc.Contact_Info 
             FROM Found_Item fi
             JOIN User u ON fi.User_ID = u.User_ID
             JOIN User_Contact uc ON u.User_ID = uc.User_ID"
        );
        while ($row = $result->fetch_assoc()) {
            echo "<li class='mb-4 p-4 border-b'>
                <p><strong>Description:</strong> {$row['Description']}</p>
                <p><strong>Date Found:</strong> {$row['Date_Found']}</p>
                <p><strong>Reported by:</strong> {$row['First_Name']} {$row['Last_Name']}</p>
                <p><strong>Contact Info:</strong> {$row['Contact_Info']}</p>
                <form action='claim_item.php' method='get' class='mt-2'>
                    <input type='hidden' name='item_id' value='{$row['Item_ID']}'>
                    <input type='hidden' name='description' value='{$row['Description']}'>
                    <button type='submit' class='bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300'>Claim</button>
                </form>
            </li>";
        }
        ?>
        </ul>
    </div>
</body>
</html>
