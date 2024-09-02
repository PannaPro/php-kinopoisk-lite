<?php /** @var App\Kernel\View\View $view */ ?>

<?php $view->component('start') ?>
    <h1>Add films</h1>

    <form action="/movies/add" method="post">
        <label for="filmname">Film name:</label><br>
        <input type="text" id="filmname" name="filmname"><br>
        <label for="genre">Genre</label><br>
        <input type="text" id="genre" name="genre"><br>
        <button>Create</button>
    </form>
<?php $view->component('end') ?>