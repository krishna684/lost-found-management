<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Found Item</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
         body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
          
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body class="bg-gray-100" >
    <?php include 'navbar.php'; ?>
    <div class="container mx-auto p-4" style="margin:100px">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include 'db_connection.php';

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $contact_info = $_POST['contact_info'];
            $description = $_POST['description'];
            $date_found = $_POST['date_found'];
            $building_name = $_POST['building_name'];
            $room_number = $_POST['room_number'];

            // Insert the user details
            $conn->query("INSERT INTO User (First_Name, Last_Name) VALUES ('$first_name', '$last_name')");
            $user_id = $conn->insert_id;

            // Insert the user contact
            $conn->query("INSERT INTO User_Contact (User_ID, Contact_Info) VALUES ($user_id, '$contact_info')");

            // Check if the building exists
            $result = $conn->query("SELECT Building_ID FROM Building WHERE Building_Name = '$building_name'");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $building_id = $row['Building_ID'];
            } else {
                // Insert new building if it doesn't exist
                $conn->query("INSERT INTO Building (Building_Name) VALUES ('$building_name')");
                $building_id = $conn->insert_id;
            }

            // Check if the location exists
            $result = $conn->query("SELECT Location_ID FROM Location WHERE Building_ID = $building_id AND Room_Number = '$room_number'");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $location_id = $row['Location_ID'];
            } else {
                // Insert new location if it doesn't exist
                $conn->query("INSERT INTO Location (Building_ID, Room_Number) VALUES ($building_id, '$room_number')");
                $location_id = $conn->insert_id;
            }

            // Insert the found item
            $conn->query("INSERT INTO Found_Item (Description, Date_Found, User_ID, Location_ID) 
                          VALUES ('$description', '$date_found', $user_id, $location_id)");

            echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4'>
                    <p>Found item reported successfully. <a href='view_items.php' class='text-blue-500 underline'>Click here to view items</a>.</p>
                  </div>";
        }
        ?>
        <h2 class="text-2xl font-bold mb-4">Report Found Item</h2>
        <form action="report_found.php" method="post" class="bg-white p-6 rounded shadow-md">
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
                <label class="block text-gray-700">Date Found:</label>
                <input type="date" name="date_found" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Building Name:</label>
                <input type="text" name="building_name" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Room Number:</label>
                <input type="text" name="room_number" required class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Submit</button>
        </form>
    </div>
</body>
</html>
