<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
    <h1>Danh sách bài viết</h1>


    <div class="post-item" style="border: 1px solid #ccc; margin-bottom: 15px; padding: 10px;">

        <?php // Truy cập vào các phần tử của mảng con ($p) bằng key ?>
        <h2>ID: <?= htmlspecialchars($post->id) ?></h2>
        <a href="index.php?id=<?php echo $post->id ?>"><?= htmlspecialchars($post->title) ?></a>
        <p><?= htmlspecialchars($post->body) ?></p>

        <div>Coment</div>
        <form action="">
            <label for="">Comment Text</label>
            <input type="text" id="idP" value="<?= $post->id ?>"  hidden>
            <input type="text" id="valueP" >
            <button id="submitButton">submit</button>
        </form>

        <!-- php comment render -->
        <div class="listComment">
            
         <?php
$sql = "SELECT * FROM comment WHERE idP = $post->id ORDER BY idComment DESC"; 
$conn = new mysqli("localhost", "root", "", "post");
$comment = mysqli_query($conn, $sql); 

while ($rows = mysqli_fetch_array($comment)) {
    echo "<li>"; 
    echo htmlspecialchars($rows['comment']); 
    echo "</li>"; 
}
?>
        </div>
    </div>

    <script src=""></script>

    <script>
        $("#submitButton").click(function (e) {
            e.preventDefault(); 
            $.ajax({
                url: './controllers/PostCommentController.php',
                method: 'POST',
                data: { idsp: $('#idP').val(), message1: $('#valueP').val()},
                success: function(res){
                    $(".listComment").prepend(
                        '<li>' + $('#valueP').val() + '</li>'
                    ); 
                    $('#valueP').val(""); 
                }
});
        })
    </script>
</body>

</html>