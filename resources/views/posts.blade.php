<!DOCTYPE html>
<title>My Blog</title>
<link rel="stylesheet" href="/app.css">

<body>
    <!-- we are going to loop through all the posts and display them -->

    <?php foreach ($posts as $post) : ?>
    <article>
        <?= $post; ?>
    </article>
    <?php endforeach; ?>

</body>