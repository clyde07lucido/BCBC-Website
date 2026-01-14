<?php
include 'db.php';

// Get table and ID
$table = $_GET['table'];
$id = intval($_GET['id']);

// Fetch record
$sql = "SELECT * FROM $table WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Get table columns dynamically
$cols_res = mysqli_query($conn, "SHOW COLUMNS FROM $table");
$columns = [];
while($col = mysqli_fetch_assoc($cols_res)) {
    if ($col['Field'] != 'id') {  // skip ID field
        $columns[] = $col['Field'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Record | BCBC Rosario</title>
<style>
    /* General Body */
    body {
        font-family: Arial, sans-serif;
        background: #e3f2fd;
        margin: 0;
        padding: 0;
    }

    /* Centered Container Card */
    .container {
        max-width: 650px;
        margin: 50px auto;
        background: #ffffff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    h2 {
        text-align: center;
        color: #0d47a1;
        margin-bottom: 25px;
    }

    /* Form styling */
    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 15px;
        font-weight: bold;
        color: #0d47a1;
    }

    input[type="text"], input[type="email"], textarea, select {
        margin-top: 5px;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #90caf9;
        font-size: 14px;
        width: 100%;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }

    input:focus, textarea:focus, select:focus {
        border-color: #1976d2;
        outline: none;
    }

    textarea {
        resize: vertical;
    }

    /* Buttons */
    button {
        margin-top: 25px;
        padding: 12px;
        background: #66af50ff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s;
    }

    button:hover {
        background: #70c855ff;
    }

    /* Back link */
    .back {
        margin-top: 20px;
        text-align: center;
    }

    .back a {
        text-decoration: none;
        color: #1976d2;
        font-weight: bold;
    }

    .back a:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 700px) {
        .container {
            padding: 20px;
        }
    }
</style>
</head>
<body>

<div class="container">
    <h2>Edit Record - <?php echo ucfirst(str_replace('_', ' ', $table)); ?></h2>

    <form action="update_record.php" method="POST">
        <input type="hidden" name="table" value="<?php echo $table; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <?php foreach($columns as $col): ?>
            <label for="<?php echo $col; ?>"><?php echo ucfirst(str_replace('_', ' ', $col)); ?></label>
            <?php if (strpos($col, 'note') !== false || strpos($col, 'reason') !== false || strpos($col, 'prayer') !== false): ?>
                <textarea id="<?php echo $col; ?>" name="<?php echo $col; ?>" rows="4"><?php echo htmlspecialchars($row[$col]); ?></textarea>
            <?php elseif(strpos($col, 'email') !== false): ?>
                <input type="email" id="<?php echo $col; ?>" name="<?php echo $col; ?>" value="<?php echo htmlspecialchars($row[$col]); ?>">
            <?php else: ?>
                <input type="text" id="<?php echo $col; ?>" name="<?php echo $col; ?>" value="<?php echo htmlspecialchars($row[$col]); ?>">
            <?php endif; ?>
        <?php endforeach; ?>

        <button type="submit">Update Record</button>
    </form>

    <div class="back">
        <a href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>
