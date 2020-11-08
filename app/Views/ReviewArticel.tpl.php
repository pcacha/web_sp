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

        <form method="post">
            <div class="form-group">
                <label for="stars" id="starsLabel" class="font-weight-bold">Počet hvězd:</label>
                <select class="form-control" id="stars" name="stars" required>
                    <?php for($i = 1; $i < 6; $i++) { ?>
                        <option value="<?= $i ?>" <?php if(isset($tplData["rev_star_count"])) if ($i == $tplData["rev_star_count"]) echo("selected") ?>><?= $i ?></option>
                    <?php } ?>
                </select>
                <script>
                    function setStars(count) {
                        let stars = "";
                        for(let i = 0; i < count; i++){
                            stars += '<span class="fa fa-star text-warning"></span>';
                        }
                        $('#starsLabel').html("Počet hvězed:   " + stars);
                    }
                    setStars($("#stars").val());
                    $("#stars").on("change", function (){
                        setStars(this.value);
                    } );
                </script>
            </div>

            <p class="font-weight-bold">Doporučit k publikaci:</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="recommend" id="yes" value="yes"
                <?php
                    if(isset($tplData["rev_recom"])){
                        $recom = $tplData["rev_recom"];
                        if($recom == 1){
                            echo("checked");
                        }
                    }
                    else{
                        echo("checked");
                    }
                ?>
                 required>
                <label class="form-check-label" for="yes">
                    Ano
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="recommend" id="no" value="no" required
                    <?php
                    if(isset($tplData["rev_recom"])){
                        $recom = $tplData["rev_recom"];
                        if($recom == 0){
                            echo("checked");
                        }
                    }

                    ?>
                >
                <label class="form-check-label" for="no">
                    Ne
                </label>
            </div>

            <div class="form-group mt-3">
                <label for="eval" class="font-weight-bold">Zhodnocení: </label>
                <textarea class="form-control" id="eval" name="eval" rows="5" required><?php if(isset($tplData["rev-eval"])){ echo($tplData["rev-eval"]);
                        }
                        else{
                            echo("Zde napište své hodnocení");
                        }
                    ?>
                </textarea>
            </div>

            <p class="text-center mt-5">
                <button type="submit" class="btn btn-lg btn-primary">Odeslat Recenzi</button>
            </p>
        </form>
    </div>
</section>
