<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Адмінпанель</a></li>
                    <li><a href="/admin/product">Управління товарами</a></li>
                    <li class="active">Видалити товар</li>
                </ol>
            </div>


            <h4>Видалити товар #<?php echo $id; ?></h4>


            <p>Ви справді хочите видалити цей товар?</p>

            <form method="post">
                <input type="submit" name="submit" value="Удалить" />
            </form>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

