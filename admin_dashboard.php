<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | BCBC Rosario</title>
<link rel="icon" href="logo.png">
<style>
body, html { margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f8; }

/* Sidebar */
.sidebar {
    height: 100vh;
    width: 220px;
    position: fixed;
    background-color: #2c3e50;
    padding-top: 20px;
}
.sidebar h2 {
    color: #fff;
    text-align: center;
    margin-bottom: 30px;
}
.sidebar a {
    display: block;
    color: #2c3e50;
    padding: 12px 20px;
    text-decoration: none;
    margin-bottom: 5px;
    border-radius: 5px;
    transition: 0.2s;
}
.sidebar a:hover, .sidebar a.active {
    background-color: #34495e;
    color: #fff;
}

/* Main */
.main {
    margin-left: 220px;
    padding: 20px;
}

/* Dashboard cards */
.cards {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}
.card {
    background-color: #fff;
    padding: 20px;
    flex: 1;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    text-align: center;
    min-width: 180px;
}
.card h3 { margin: 0; color: #333; }
.card p { font-size: 18px; color: #555; }

/* Tables */
table { 
    width: 100%; 
    border-collapse: collapse; 
    background-color: #fff; 
    border-radius: 8px; 
    overflow: hidden; }

th, td { 
    padding: 12px; 
    text-align: left; }

th { 
    background-color: #2980b9; 
    color: #fff; }

tr:nth-child(even) { 
    background-color: #f2f2f2; }
tr:hover { background-color: #dfe6e9; }

a.edit { 
    color: #2980b9; 
    font-weight: bold; 
    text-decoration: none; }
a.edit:hover { 
    text-decoration: underline; }

a.delete { 
    color: #e74c3c; 
    font-weight: bold; 
    text-decoration: none; }
a.delete:hover {
    text-decoration: underline; }

/* Tabs */
.tabcontent { 
    display: none; }

.tablinks { 
    background-color: #ecf0f1; 
    border: none; 
    padding: 10px 15px; 
    cursor: pointer; 
    margin-right: 5px; 
    border-radius: 5px 5px 0 0; }

.tablinks.active { 
    background-color: #fff; 
    border-bottom: 2px solid #fff; 
    font-weight: bold; }

/* Header */
.header {
    background-color: #2980b9;
    color: #fff;
    padding: 15px 20px;
    margin-left: 220px;
    font-size: 24px;
}
</style>
</head>
<body>

<div class="sidebar">
    <h2>BCBC Admin</h2>
    <a class="tablinks" onclick="openTab(event, 'Prayer')">Prayer Requests</a>
    <a class="tablinks" onclick="openTab(event, 'Registration')">Registrations</a>
    <a class="tablinks" onclick="openTab(event, 'Reservation')">Reservations</a>
    <a class="tablinks" onclick="openTab(event, 'Users')">Users</a>
</div>

<div class="header">Admin Dashboard</div>

<div class="main">
    <!-- Dashboard cards -->
    <div class="cards">
        <div class="card">
            <h3>Total Prayers</h3>
            <p><?php
            $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM prayer_requests");
            $row = mysqli_fetch_assoc($res);
            echo $row['total'];
            ?></p>
        </div>
        <div class="card">
            <h3>Total Registrations</h3>
            <p><?php
            $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrations");
            $row = mysqli_fetch_assoc($res);
            echo $row['total'];
            ?></p>
        </div>
        <div class="card">
            <h3>Total Reservations</h3>
            <p><?php
            $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM reservations");
            $row = mysqli_fetch_assoc($res);
            echo $row['total'];
            ?></p>
        </div>
        <div class="card">
            <h3>Total Users</h3>
            <p><?php
            $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
            $row = mysqli_fetch_assoc($res);
            echo $row['total'];
            ?></p>
        </div>
    </div>

    <!-- Prayer Requests Table -->
    <div id="Prayer" class="tabcontent">
        <h2>Prayer Requests</h2>
        <form method="GET" action="" style="margin-bottom:15px;">
            <input type="hidden" name="active_tab" value="Prayer">
            <input type="text" name="search_prayer" placeholder="Search..." value="<?php echo htmlspecialchars($_GET['search_prayer'] ?? ''); ?>" style="padding:7px; border-radius:5px; width:200px;">
            <button type="submit" style="padding:7px 10px; border-radius:5px;">Search</button>
        </form>
        <table>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Pray To</th><th>Prayer</th><th>Date</th><th>Actions</th></tr>
            <?php
            $search = $_GET['search_prayer'] ?? '';
            $sql = "SELECT * FROM prayer_requests";
            if(!empty($search)){
                $search_safe = mysqli_real_escape_string($conn,$search);
                $sql .= " WHERE name LIKE '%$search_safe%' OR email LIKE '%$search_safe%' OR pray_to LIKE '%$search_safe%' OR prayer_request LIKE '%$search_safe%'";
            }
            $sql .= " ORDER BY id DESC";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['pray_to']}</td>
                <td>{$row['prayer_request']}</td>
                <td>{$row['date_submitted']}</td>
                <td>
                <a class='edit' href='edit_record.php?table=prayer_requests&id={$row['id']}'>Edit</a> | 
                <a class='delete' href='delete_record.php?table=prayer_requests&id={$row['id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                </td>
                </tr>";
            }
            ?>
        </table>
    </div>

    <!-- Registrations Table -->
    <div id="Registration" class="tabcontent">
        <h2>Ministry Registrations</h2>
        <form method="GET" action="" style="margin-bottom:15px;">
            <input type="hidden" name="active_tab" value="Registration">
            <input type="text" name="search_registration" placeholder="Search..." value="<?php echo htmlspecialchars($_GET['search_registration'] ?? ''); ?>" style="padding:7px; border-radius:5px; width:200px;">
            <button type="submit" style="padding:7px 10px; border-radius:5px;">Search</button>
        </form>
        <table>
            <tr><th>ID</th><th>Name</th><th>Age</th><th>Contact</th><th>Email</th><th>Ministry</th><th>Reason</th><th>Actions</th></tr>
            <?php
            $search = $_GET['search_registration'] ?? '';
            $sql = "SELECT * FROM registrations";
            if(!empty($search)){
                $search_safe = mysqli_real_escape_string($conn,$search);
                $sql .= " WHERE name LIKE '%$search_safe%' OR contact LIKE '%$search_safe%' OR email LIKE '%$search_safe%' OR ministry LIKE '%$search_safe%' OR reason LIKE '%$search_safe%'";
            }
            $sql .= " ORDER BY id DESC";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['age']}</td>
                <td>{$row['contact']}</td>
                <td>{$row['email']}</td>
                <td>{$row['ministry']}</td>
                <td>{$row['reason']}</td>
                <td>
                <a class='edit' href='edit_record.php?table=registrations&id={$row['id']}'>Edit</a> | 
                <a class='delete' href='delete_record.php?table=registrations&id={$row['id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                </td>
                </tr>";
            }
            ?>
        </table>
    </div>

    <!-- Reservations Table -->
    <div id="Reservation" class="tabcontent">
        <h2>Reservations</h2>
        <form method="GET" action="" style="margin-bottom:15px;">
            <input type="hidden" name="active_tab" value="Reservation">
            <input type="text" name="search_reservation" placeholder="Search..." value="<?php echo htmlspecialchars($_GET['search_reservation'] ?? ''); ?>" style="padding:7px; border-radius:5px; width:200px;">
            <button type="submit" style="padding:7px 10px; border-radius:5px;">Search</button>
        </form>
        <table>
            <tr><th>ID</th><th>Name</th><th>Contact</th><th>Merch</th><th>Size</th><th>Quantity</th><th>Note</th><th>Actions</th></tr>
            <?php
            $search = $_GET['search_reservation'] ?? '';
            $sql = "SELECT * FROM reservations";
            if(!empty($search)){
                $search_safe = mysqli_real_escape_string($conn,$search);
                $sql .= " WHERE name LIKE '%$search_safe%' OR contact LIKE '%$search_safe%' OR merch LIKE '%$search_safe%' OR note LIKE '%$search_safe%'";
            }
            $sql .= " ORDER BY id DESC";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['contact']}</td>
                <td>{$row['merch']}</td>
                <td>{$row['size']}</td>
                <td>{$row['qty']}</td>
                <td>{$row['note']}</td>
                <td>
                <a class='edit' href='edit_record.php?table=reservations&id={$row['id']}'>Edit</a> | 
                <a class='delete' href='delete_record.php?table=reservations&id={$row['id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                </td>
                </tr>";
            }
            ?>
        </table>
    </div>

    <!-- Users Table -->
    <div id="Users" class="tabcontent">
        <h2>Users</h2>
        <form method="GET" action="" style="margin-bottom:15px;">
            <input type="hidden" name="active_tab" value="Users">
            <input type="text" name="search_users" placeholder="Search..." value="<?php echo htmlspecialchars($_GET['search_users'] ?? ''); ?>" style="padding:7px; border-radius:5px; width:200px;">
            <button type="submit" style="padding:7px 10px; border-radius:5px;">Search</button>
        </form>
        <table>
            <tr><th>ID</th><th>Full Name</th><th>Age</th><th>Email</th><th>Actions</th></tr>
            <?php
            $search = $_GET['search_users'] ?? '';
            $sql = "SELECT * FROM users";
            if(!empty($search)){
                $search_safe = mysqli_real_escape_string($conn,$search);
                $sql .= " WHERE fullname LIKE '%$search_safe%' OR email LIKE '%$search_safe%'";
            }
            $sql .= " ORDER BY id DESC";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['fullname']}</td>
                <td>{$row['age']}</td>
                <td>{$row['email']}</td>
                <td>
                <a class='edit' href='edit_record.php?table=users&id={$row['id']}'>Edit</a> | 
                <a class='delete' href='delete_record.php?table=users&id={$row['id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                </td>
                </tr>";
            }
            ?>
        </table>
    </div>

</div>

<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) { tabcontent[i].style.display = "none"; }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) { tablinks[i].className = tablinks[i].className.replace(" active", ""); }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Open active tab based on GET parameter or default to Prayer
var activeTab = "<?php echo $_GET['active_tab'] ?? 'Prayer'; ?>";
var tabLink = Array.from(document.getElementsByClassName('tablinks')).find(el => el.getAttribute('onclick').includes(activeTab));
if(tabLink) tabLink.click();
</script>

</body>
</html>
