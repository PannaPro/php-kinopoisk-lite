<?php
/** @var App\Kernel\View\View $view */
/** @var App\Kernel\Session\Session $session */
?>

<?php $view->component('start') ?>
    <h1>Add films</h1>

    <form action="/movies/add" method="post" enctype="multipart/form-data">
        <label for="name">Film name:</label><br>
        <input type="text" id="name" name="name"><br>
        <?php if ($session->get('name')) { ?>
                <?php foreach ($session->getFlash('name') as $error) { ?>
                <p style="color: red; font-size: small"> <?php echo $error ?> </p>
                <?php } ?>
        <?php } ?>
        <label for="genre">Genre</label><br>
            <input type="text" id="genre" name="genre"><br>
        <label for="image">Poster</label><br>
            <input type="file" name="image"><br>
        <button style="margin-top:10px">Create</button>
    </form>
<?php $view->component('end') ?>