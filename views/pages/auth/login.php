<?php
/** @var App\Kernel\View\View $view */
/** @var App\Kernel\Session\Session $session */
?>

<?php $view->component('start') ?>
    <h1>Login page</h1>

    <form action="/login" method="post">
        <?php if ($session->has('error')) { ?>
            <p style="color: red; font-size: small">
                <?php echo $session->getFlash('error') ?>
            </p>
        <?php } ?>
        <label for="email">Name</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password" required><br>

        <button style="margin-top:10px">Login</button>
    </form>
<?php $view->component('end') ?>