<?php
/** @var App\Kernel\View\View $view */
/** @var App\Kernel\Session\Session $session */
?>

<?php $view->component('start') ?>
    <h1>Registry page</h1>

    <form action="/registry" method="post">
        <label for="email">Name</label><br>
        <input type="email" id="email" name="email" required><br>
        <?php if ($session->get('email')) { ?>
            <?php foreach ($session->getFlash('email') as $error) { ?>
                <p style="color: red; font-size: small"> <?php echo $error ?> </p>
            <?php } ?>
        <?php } ?>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password" required><br>
        <?php if ($session->get('password')) { ?>
            <?php foreach ($session->getFlash('password') as $error) { ?>
                <p style="color: red; font-size: small"> <?php echo $error ?> </p>
            <?php } ?>
        <?php } ?>
        <button style="margin-top:10px">Registry</button>
    </form>
<?php $view->component('end') ?>