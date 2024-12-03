

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            width: 90%;
        }
        .container h1 {
            font-size: 24px;
            color: #343a40;
            margin-bottom: 10px;
        }
        .container p {
            font-size: 16px;
            color: #495057;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            margin: 10px 0;
            font-size: 16px;
        }
        ul li strong {
            color: #007bff;
        }
        .success {
            color: #28a745;
            font-weight: bold;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Claim Item</h1>
        <?php
require_once 'db_connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['item_id'], $_POST['user_name'], $_POST['user_contact'])) {
        $itemID = intval($_POST['item_id']);
        $userName = $conn->real_escape_string($_POST['user_name']);
        $userContact = $conn->real_escape_string($_POST['user_contact']);
        $dateClaimed = date('Y-m-d');

        try {
            // Split name into first and last
            $names = explode(' ', $userName, 2);
            $firstName = $names[0];
            $lastName = $names[1] ?? '';

            // Add user details
            $userQuery = "INSERT INTO User (First_Name, Last_Name) VALUES (?, ?)";
            $stmt = $conn->prepare($userQuery);
            $stmt->bind_param('ss', $firstName, $lastName);
            $stmt->execute();
            $userID = $stmt->insert_id;

            // Add contact info
            $contactQuery = "INSERT INTO User_Contact (User_ID, Contact_Info) VALUES (?, ?)";
            $stmt = $conn->prepare($contactQuery);
            $stmt->bind_param('is', $userID, $userContact);
            $stmt->execute();

            // Insert into Lost_Item (since we need to reference this for the claim)
            $foundItemQuery = "SELECT * FROM Found_Item WHERE Item_ID = ?";
            $stmt = $conn->prepare($foundItemQuery);
            $stmt->bind_param('i', $itemID);
            $stmt->execute();
            $result = $stmt->get_result();
            $foundItem = $result->fetch_assoc();

            if ($foundItem) {
                // Now insert the item into the Lost_Item table
                $insertLostItemQuery = "INSERT INTO Lost_Item (Description, Date_Lost, User_ID) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($insertLostItemQuery);
                $stmt->bind_param('ssi', $foundItem['Description'], $foundItem['Date_Found'], $userID);
                $stmt->execute();
                $lostItemID = $stmt->insert_id;  // Get the ID of the new Lost_Item

                // Insert into Claim table
                $claimQuery = "INSERT INTO Claim (User_ID, Item_ID, Date_Claimed) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($claimQuery);
                $stmt->bind_param('iis', $userID, $lostItemID, $dateClaimed);
                $stmt->execute();

                // Fetch reporter details
                $foundItemQuery = "
                    SELECT 
                        FI.Description, FI.Date_Found, 
                        U.First_Name, U.Last_Name, 
                        UC.Contact_Info
                    FROM Found_Item FI
                    INNER JOIN User U ON FI.User_ID = U.User_ID
                    INNER JOIN User_Contact UC ON U.User_ID = UC.User_ID
                    WHERE FI.Item_ID = ?";
                $stmt = $conn->prepare($foundItemQuery);
                $stmt->bind_param('i', $itemID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $reporterDetails = $result->fetch_assoc();
                }

                // Remove from Found_Item
                $deleteFoundQuery = "DELETE FROM Found_Item WHERE Item_ID = ?";
                $stmt = $conn->prepare($deleteFoundQuery);
                $stmt->bind_param('i', $itemID);
                $stmt->execute();

                // Display success message and reporter details
                echo "<p>Item claimed successfully!</p>";
                echo "<p><strong>Reporter Details:</strong></p>";
                echo "<ul>";
                echo "<li><strong>Name:</strong> " . htmlspecialchars($reporterDetails['First_Name']) . " " . htmlspecialchars($reporterDetails['Last_Name']) . "</li>";
                echo "<li><strong>Contact Info:</strong> " . htmlspecialchars($reporterDetails['Contact_Info']) . "</li>";
                echo "<li><strong>Item Description:</strong> " . htmlspecialchars($reporterDetails['Description']) . "</li>";
                echo "<li><strong>Date Found:</strong> " . htmlspecialchars($reporterDetails['Date_Found']) . "</li>";
                echo "</ul>";
                echo "<a href='view_items.php'>Go back to View Items</a>";
            } else {
                echo "<p>Item not found.</p>";
            }

        } catch (Exception $e) {
            die("Error processing the claim: " . $e->getMessage());
        }
    } else {
        die("Invalid request! Missing required fields.");
    }
} else {
    die("Invalid request! Only POST requests are allowed.");
}
?>

    </div>
</body>
</html>
