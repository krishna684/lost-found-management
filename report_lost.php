<?php include 'navbar.php'; ?>
<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Lost Item</title>
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
    <div class="container mx-auto p-4">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $contact_info = $_POST['contact_info'];
            $description = $_POST['description'];
            $date_lost = $_POST['date_lost'];

            // Insert the user details
            $conn->query("INSERT INTO User (First_Name, Last_Name) VALUES ('$first_name', '$last_name')");
            $user_id = $conn->insert_id;

            // Insert the user contact
            $conn->query("INSERT INTO User_Contact (User_ID, Contact_Info) VALUES ($user_id, '$contact_info')");

            // Insert the lost item
            $conn->query("INSERT INTO Lost_Item (Description, Date_Lost, User_ID) 
                          VALUES ('$description', '$date_lost', $user_id)");

            echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4'>
                    <p>Lost item reported successfully. <a href='view_items.php' class='text-blue-500 underline'>Click here to view items</a>.</p>
                  </div>";
        }
        ?>
        <h2 class="text-2xl font-bold mb-4">Report Lost Item</h2>
        <form action="report_lost.php" method="post" class="bg-white p-6 rounded shadow-md">
            <div class="mb-4">
                <label class="block text-gray-700">First Name:</label>
                <input type="text" name="first_name" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Last Name:</label>
                <input type="text" name="last_name" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Contact Info:</label>
                <input type="text" name="contact_info" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Item Description:</label>
                <input type="text" name="description" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Date Lost:</label>
                <input type="date" name="date_lost" required class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Submit</button>
        </form>
    </div>
</body>
</html>
