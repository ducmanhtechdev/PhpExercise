<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
</head>
<body>
    <h1>Danh sách bài viết</h1>

    
        <div class="post-item" style="border: 1px solid #ccc; margin-bottom: 15px; padding: 10px;">
            
            <?php // Truy cập vào các phần tử của mảng con ($p) bằng key ?>
            <h2>ID: <?= htmlspecialchars($post -> id) ?></h2>
            <a href="index.php?id=<?php echo $post -> id ?>"><?= htmlspecialchars($post -> title) ?></a>
            <p><?= htmlspecialchars($post -> body) ?></p>

        </div>

</body>
</html>