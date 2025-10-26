<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
</head>
<body>
    <h1>Danh sách bài viết</h1>

    <?php foreach($post as $p): ?>
        <div class="post-item" style="border: 1px solid #ccc; margin-bottom: 15px; padding: 10px;">
            
            <?php // Truy cập vào các phần tử của mảng con ($p) bằng key ?>
            <h2>ID: <?= htmlspecialchars($p['id']) ?></h2>
            <a href="index.php?id=<?php echo $p['id'] ?>"><?= htmlspecialchars($p['title']) ?></a>
            <p><?= htmlspecialchars($p['body']) ?></p>
            
        </div>
    <?php endforeach; ?>

</body>
</html>