<?php
/** @var App\Kernel\View\View $view */
/** @var App\Kernel\Session\Session $session */
?>

<?php $view->component('start') ?>
    <h1>Add films</h1>

    <form action="/movies/add" method="post">
        <label for="filmname">Film name:</label><br>
        <input type="text" id="filmname" name="filmname"><br>
        <?php if ($session->get('filmname')) { ?>
                <?php foreach ($session->getFlash('filmname') as $error) { ?>
                <p style="color: red; font-size: small"> <?php echo $error ?> </p>
                <?php } ?>
        <?php } ?>
        <label for="genre">Genre</label><br>
        <input type="text" id="genre" name="genre"><br>
        <button style="margin-top:10px">Create</button>
    </form>
<?php $view->component('end') ?>