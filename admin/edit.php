<?php require_once '../backend/include.php';
if (!$_GET["create"])
    $article = $articleMgr->getArticle($_GET["id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
    <script
            src="http://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script>
        $(function () {
            $("#saveBtn").click(function () {
                $('#status').text("Saving...");
                $.post(
                    "submit_article.php",
                    $.param({
                        create: <?php echo $_GET["create"]; ?>,
                        content: $("#contentText").val(),
                        preview: $("#previewText").val(),
                        defaultDisplayOrder: $('#defaultDisplayOrder').val(),
                        navLabel: $("#navLabel").val()
                    }),
                    function (data) {
                        if (data)
                            console.log(data);
                        console.log("Success");
                        $('#status').text("Success");
                        window.location = "/admin";
                    }
                );
            });
        })
    </script>
</head>
<body>
<div class="container">
    <div class="content">
        <h1>Edit Article</h1>
        <h2>Article ID: <?php
            if (isset($article)) echo $article->id;
            else echo "New";
            ?></h2>

        <div class="line">Nav label:
            <input id="navLabel" title="navLabel" value="<?php
            if (isset($article)) echo $article->getNavLabel();
            ?>"/></div>

        <div class="line">Default display order:
            <input id="defaultDisplayOrder" title="defaultDisplayOrder" value="<?php
            if (isset($article)) echo $article->getDefaultDisplayOrder();
            ?>"/></div>

        <div class="line"> Preview:</div>
        <div class="line">
            <textarea id="previewText" title="previewText">
            <?php
            if (isset($article)) echo $article->getPreview()
            ?>
            </textarea>
        </div>

        <div class="line"> Content:</div>
        <div class="line">
            <textarea id="contentText" title="contentText">
             <?php
             if (isset($article)) echo $article->getContent()
             ?>
            </textarea>
        </div>

        <div class="line">
            <button id="saveBtn">Save</button>
        </div>
        <div class="line">
            <div id="status">Status</div>
        </div>
    </div>
</div>
</body>
</html>