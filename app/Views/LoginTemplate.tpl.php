<?php
global $tplData;

?>
<section>
    <div class="mx-auto bg-white mt-5 border rounded p-5 login-div">
        <form method="post">
            <h4>Přihlásit se</h4>
            <div class="form-group">
                <label for="name">Jméno</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Zadej jméno">
            </div>
            <div class="form-group">
                <label for="pass">Heslo</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Zadej heslo">
            </div>

            <button type="submit" class="btn btn-primary w-100 my-2">Přilásit se</button>

            <a href="../../index.php?page=registrace">Nemáte účet? Zaregistrujte se</a>
        </form>
    </div>
</section>

