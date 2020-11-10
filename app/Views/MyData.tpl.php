<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded p-md-5 p-2 container create-articel">

        <h2 class="mb-5">Moje Údaje</h2>

        <?php if(isset($tplData["message"])): ?>
            <div class="alert <?php echo($tplData["res"] ? "alert-success" : "alert-danger"); ?>" role="alert">
                <?= $tplData["message"] ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div><span class="font-weight-bold">datum registrace: </span> <?= date("d.m. Y", strtotime( $tplData["reg_date"])) ?></div>
            <br>
            <div class="form-group">
                <label for="name">Jméno</label>
                <input type="text" class="form-control" required id="name" name="name" value="<?= $tplData["name"] ?>">
            </div>
            <div class="form-check my-2">
                <input type="checkbox" class="form-check-input" id="changePass" name="changePass">
                <label for="changePass" class="form-check-label">Změnit heslo</label>
            </div>
            <div class="form-group">
                <label for="pass1">Heslo</label>
                <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Zadej nové heslo">
            </div>
            <div class="form-group">
                <label for="pass2">Kontrolní Heslo</label>
                <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Zadej nové heslo znovu">
            </div>

            <script>
                let check = $("#changePass");
                check.click(function () {
                    if(check.prop('checked') === true){
                        $("#pass1").prop('required', true);
                    }
                    else{
                        $("#pass1").prop('required', false);
                    }
                });
            </script>

            <button type="submit" class="btn btn-primary w-100 mt-3">Aktualizovat údaje</button>
        </form>
    </div>
</section>