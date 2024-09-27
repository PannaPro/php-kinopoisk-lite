<?php
/** @var App\Kernel\View\View $view */
/** @var App\Kernel\Session\SessionInterface $session */
?>

<?php $view->component('start'); ?>

<main>
    <div class="container d-flex justify-content-center">
        <form action="/admin/movies/add" method="post" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
            <h3 class="standart-font text-center mb-3">Добавить фильм</h3>
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control <?php echo $session->has('name') ? 'is-invalid' : '' ?>"
                               id="name"
                               name="name"
                               required
                        >
                        <label for="name">Название</label>
                        <?php if ($session->has('name')) { ?>
                            <div id="name" class="invalid-feedback">
                                <?php echo $session->getFlash('name')[0] ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <textarea class="form-control"
                                  id="description"
                                  name="description"
                                  required
                        >

                        </textarea>
                        <label for="email">Описание</label>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control"
                               id="director"
                               name="director">
                        <label for="director">Режисер</label>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" aria-label="default select">
                            <option class="form-option" style="display:none"></option>

                            <option class="dropdown-item-text">Песни</option>
                            <option class="dropdown-item-text">Ансамбль</option>

                        </select>
                        <label for="form-option">Выбрать категорию</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="duration" name="duration">
                        <label for="duration">Продолжительность (мин)</label>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <button class="btn btn-primary">Добавить фильм</button>
            </div>
        </form>
    </div>
</main>

<?php $view->component('end'); ?>

