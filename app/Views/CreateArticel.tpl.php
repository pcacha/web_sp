<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded p-5 create-articel">

        <?php if(isset($tplData["message"])): ?>
            <div class="alert <?php echo($tplData["res"] ? "alert-success" : "alert-danger"); ?>" role="alert">
                <?= $tplData["message"] ?>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="font-weight-bold">Název Článku:</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Zadejte název článku"
                    <?php
                    if(isset($tplData["articel_name"])){
                        echo(' value = "'.$tplData["articel_name"].'"');
                    }
                    ?>
                >
            </div>

            <p class="font-weight-bold">Článek:</p>
            <div class="custom-file">
                <input type="file" accept="application/pdf" class="custom-file-input" id="articel" name="articel" <?php if(!isset($tplData["document_name"])) echo("required") ?>>
                <label class="custom-file-label" for="articel">
                    <?php
                    if(isset($tplData["document_name"])){
                        echo($tplData["document_name"]);
                    }
                    else{
                        echo("Vyberte pdf dokument");
                    }
                    ?>
                </label>
            </div>
            <script>
                $('#articel').on('change',function(){
                    let fileName = $(this).val();
                    fileName = fileName.replace('C:\\fakepath\\', " ");
                    $(this).next(".custom-file-label").html(fileName);
                })
            </script>

            <div class="form-group mt-3">
                <label for="abstract" class="font-weight-bold">Abstrakt:</label>
                <textarea class="ckeditor" id="abstract" name="abstract" required>
                     <?php
                     if(isset($tplData["abstract"])){
                         echo($tplData["abstract"]);
                     }
                     else{
                         echo("Napište abstrakt článku");
                     }
                     ?>
                </textarea>
            </div>

            <?php if(isset($tplData["articel_id"])): ?>
                <input type="hidden" name="id" value="<?= $tplData["articel_id"] ?>">
            <?php endif; ?>

            <p class="text-center mt-5">
                <button type="submit" class="btn btn-lg btn-primary">Publikovat Článek</button>
            </p>
        </form>
    </div>
</section>
