<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded p-md-5 p-2 container create-articel">

        <?php if(isset($tplData["message"])): ?>
            <div class="alert <?php echo($tplData["res"] ? "alert-success" : "alert-danger"); ?>" role="alert">
                <?= $tplData["message"] ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <p class="font-weight-bold">Publikovat:</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="publish" id="yes" value="yes" required>
                <label class="form-check-label" for="yes">
                    Ano
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="publish" id="no" value="no" required>
                <label class="form-check-label" for="no">
                    Ne
                </label>
            </div>

            <div class="form-group mt-3">
                <label for="eval" class="font-weight-bold">Zhodnocení: </label>
                <textarea class="form-control" id="eval" name="eval" rows="5" required="required">Zde napište své hodnocení
                </textarea>
            </div>

            <p class="text-center mt-5">
                <button type="submit" class="btn btn-lg btn-primary">Odeslat Hodnocení</button>
            </p>
        </form>
    </div>
</section>
