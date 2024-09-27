<?php
/** @var App\Kernel\View\View $view */
/** @var App\Kernel\Session\SessionInterface $session */
?>

<?php $view->component('start'); ?>

<main>
    <div class="container">
        <h3 class="mt-3 standart-font">Панель администрирования</h3>
        <hr>
    </div>
    <div class="container d-flex justify-content-center">
        <form action="/admin/categories/add" method="post" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
            <h4 class="mt-3 standart-font text-center">Добавить категорию фильмов</h4>

            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control <?php echo $session->has('name') ? 'is-invalid' : '' ?>"
                               id="name"
                               name="name"
                               placeholder="Комедии">
                        <label for="name">Имя</label>
                        <?php if ($session->has('name')) { ?>
                            <div id="name" class="invalid-feedback">
                                <?php echo $session->getFlash('name')[0] ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <button class="btn btn-primary">Создать категорию</button>
            </div>
        </form>
    </div>
</main>

<?php $view->component('end'); ?>

