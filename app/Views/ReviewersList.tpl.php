<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded p-2 p-md-5 create-articel container">

        <h2 class="mb-5">Recenzenti Článku</h2>

        <?php if(!isset($tplData["reviewers"]) || !$tplData["reviewers"]): ?>
            <h3>Nejsou zde žádní recenzenti</h3>
        <?php endif;?>

        <?php foreach ($tplData["reviewers"] as $key => $item): ?>
            <div class="card mb-4" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h5><?= $item["name"] ?></h5>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="font-weight-bold">registrace: </span><?= date("d.m. Y", strtotime( $item["reg_date"])) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>