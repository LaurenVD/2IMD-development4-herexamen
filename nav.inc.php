<link rel="stylesheet" href="css/navigation.css?v=<?php echo time(); ?>">

<div class="container">
    <h1>TODO APP</h1>
    <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
    <a href="admin.php">Admin</a>
    <?php endif; ?>
    <a href="logout.php" class="logout">Logout</a>
</div>