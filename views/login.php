<?php
/** @var App\Kernel\View\View $view */
/** @var App\Kernel\Session\SessionInterface $session */
?>

<?php $view->component('start_basic'); ?>

<main class="form-signin w-100 m-auto">
    <form action="/login" method="post">
        <div style="align-items: center; justify-content: space-between">
            <h2 class="standart-font">Вход</h2>
            <a href="/" class="d-flex align-items-center mb-5 mb-lg-0 text-white text-decoration-none">
                <h5 class="m-0">Кинопоиск <span class="badge bg-warning warn__badge">Lite</span></h5>
            </a>
        </div>
        <div class="form-floating mt-3">
            <input type="email" class="form-control" id="email" name="email"> <label for="email">E-mail</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password"> <label for="password">Пароль</label>
        </div>
        <?php if ($session->has('error')) { ?>
            <div class="alert alert-danger form-floating mt-3">
                <?php echo $session->getFlash('error') ?>
            </div>
        <?php } ?>
        <button class="btn btn-primary w-100 py-2" type="submit">Войти</button>
        <p class="mt-5 mb-3 text-body-secondary ">&copy; Кинопоиск Lite 2023</p>
    </form>
</main>

<?php $view->component('end_basic'); ?>
