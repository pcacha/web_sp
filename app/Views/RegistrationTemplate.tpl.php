<?php
global $tplData;

?>
<section>
    <div class="mx-auto bg-white mt-5 border rounded p-5 login-div">

        <?php if (isset($tplData["message"])): ?>
            <div class="alert <?php echo($tplData["res"] ? "alert-success" : "alert-danger"); ?>" role="alert">
                <?= $tplData["message"] ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <h4>Registrovat se</h4>
            <div class="form-group">
                <label for="name">Jméno</label>
                <input type="text" class="form-control" required id="name" name="name" placeholder="Zadej jméno">
            </div>
            <div class="form-group">
                <label for="pass1">Heslo</label>
                <input type="password" class="form-control" required id="pass1" name="pass1" placeholder="Zadej heslo">
            </div>
            <div class="form-group">
                <label for="pass2">Kontrolní Heslo</label>
                <input type="password" class="form-control" required id="pass2" name="pass2" placeholder="Zadej heslo znovu">
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Registrovat se</button>
        </form>
    </div>
</section>