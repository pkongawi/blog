<!DOCTYPE html>
<title>My Blog</title>
<link rel="stylesheet" href="/app.css">

<body>
    <!-- we are going to loop through all the posts and display them -->

    <?php foreach ($posts as $post) : ?>
    <article>
        <h1><a href="/posts/{{$post->slug}}"> {{$post->title}}  </a> </h1>
        <h2> {{$post->excerpt}} </h2>
    </article>
    <?php endforeach; ?>

</body>