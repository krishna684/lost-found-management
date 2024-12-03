<?php include 'navbar.php'; ?>
<?php
require_once 'db_connection.php';

if (!isset($_GET['item_id'])) {
    die("Invalid request! Item ID is missing.");
}

$itemID = intval($_GET['item_id']);

// Fetch item details
$itemQuery = "SELECT * FROM Found_Item WHERE Item_ID = $itemID";
$itemResult = $conn->query($itemQuery);

if ($itemResult->num_rows === 0) {
    die("Invalid request! Item not found.");
}

$item = $itemResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Item</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 60px;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-roboto">
    <div class="container mx-auto p-4">
        <header class="mb-6">
            <h1 class="text-3xl font-bold text-center text-gray-800">Claim Item</h1>
        </header>
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="claim_process.php" method="POST">
                <input type="hidden" name="item_id" value="<?php echo $item['Item_ID']; ?>">

                <div class="mb-4">
                    <p class="text-lg"><strong>Item Description:</strong> <?php echo $item['Description']; ?></p>
                </div>
                <div class="mb-4">
                    <p class="text-lg"><strong>Date Found:</strong> <?php echo $item['Date_Found']; ?></p>
                </div>

                <div class="mb-4">
                    <label for="user_name" class="block text-gray-700 font-medium mb-2">Your Name:</label>
                    <input type="text" id="user_name" name="user_name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="user_contact" class="block text-gray-700 font-medium mb-2">Your Contact Information:</label>
                    <input type="text" id="user_contact" name="user_contact" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-check"></i> Claim Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
