<?php
require_once '../backend/admin_include.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
</head>
<body>
<div class="container">
    <div class="content">
        <h1>Admin Panel</h1>
        <h2 id="article-list-header">Articles</h2>
        <table id="article-table">
            <tr>
                <th>ID</th>
                <th>Nav bar title</th>
                <th>Controls</th>
            </tr>
            <?php foreach ($articleIDs as $id) {
                $article = $articleMgr->getArticle($id);
                ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo htmlspecialchars($article->getNavLabel()); ?></td>
                    <td>
                        <a href="edit.php?create=0&id=<?php echo $id; ?>">Edit</a>
                        <a href="submit_article.php?delete=1&articleID=<?php echo $id; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a id="add-article" href="edit.php?create=1">Add article</a>
        <br><br>
        <form action="change_password.php" method="post">
            Set password: <input title="password" name="password">
            <input type="submit" value="Change password">
        </form>
        <br><br>
        <a href="logout.php">Logout</a>
        <br><br>
        PHP Version: <?php echo phpversion(); ?>
    </div>
</div>
</body>
</html>