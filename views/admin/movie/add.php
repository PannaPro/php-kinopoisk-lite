<?php
/** @var App\Kernel\View\View $view */
/** @var App\Kernel\Session\SessionInterface $session */
/** @var array<\App\Entity\Category> $categories */

?>

<?php $view->component('start'); ?>

<main>
    <div class="container d-flex justify-content-between">
        <div class="d-flex flex-row gap-4 mt-5 mb-5 w-100">

            <form action="/admin/movies/add"
                  method="post"
                  enctype="multipart/form-data"
                  class="d-flex flex-column justify-content-center w-50 gap-2"
            >
                <h3 class="standart-font text-center mb-3">Добавление фильма</h3>
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
                            ></textarea>
                            <label for="description">Описание</label>
                            <?php if ($session->has('description')) { ?>
                                <div id="name" class="invalid-feedback">
                                    <?php echo $session->getFlash('description')[0] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control"
                                   id="director"
                                   name="director">
                            <label for="director">Режиссер</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="file" class="form-control"
                                   id="image"
                                   name="image"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            <label for="image">Постер</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" aria-label="default select" id="category" name="category">
<!--                                <option class="form-option" style="display:none" value="">Выбрать категорию</option>-->
                                <?php foreach ($categories as $category) { ?>
                                    <option class="dropdown-item-text" value="<?php echo $category->getId(); ?>">
                                        <?php echo $category->getName(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <label for="category">Выбрать категорию</label>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="duration" name="duration">
                            <label for="duration">Продолжительность (мин)</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <button class="btn btn-success">Добавить</button>
                </div>
            </form>

            <div class="image-container d-flex align-items-center justify-content-center w-75">
                <img id="imagePreview" src="" alt="Предварительный просмотр" style="max-width: 100%; display: none;">
            </div>

        </div>
    </div>
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</main>

<?php $view->component('end'); ?>
