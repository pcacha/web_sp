<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded p-md-5 p-2 container create-articel">

        <h2 class="mb-5">Recenze Článku</h2>

        <?php if(!isset($tplData["reviews"]) || !$tplData["reviews"]): ?>
            <h3>Nejsou zde žádné recenze</h3>
        <?php endif;?>

        <?php foreach ($tplData["reviews"] as $item): ?>
            <div class="card mb-4" >
                <div class="card-body border rounded">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <span class="card-text text-secondary">autor recenze:</span>
                            <p class="card-text text-info"> <?=  $item["rev_author"] ?></p>
                            <h4 class="text-warning">
                                <?php for($i = 0; $i < $item["stars_count"]; $i++) { ?>
                                    <i class="fa fa-star"></i>
                                <?php } ?>
                            </h4>
                            <h4>
                                Doporučit:
                                <?php if($item["recommended"] == 0): ?>
                                    <i class="fa fa-thumbs-down text-danger"></i>
                                <?php endif; ?>
                                <?php if($item["recommended"] == 1): ?>
                                    <i class="fa fa-thumbs-up text-success" text-success"></i>
                                <?php endif; ?>
                            </h4>
                        </div>

                        <div class="col-12 col-md-9 mt-3 mt-md-0">
                            <h4 class="card-title font-italic"><?= $item["articel_name"] ?></h4>
                            <hr>
                            <h5 class="mt-3">Recenze:</h5>
                            <p class="mt-3 mt-1">
                                <?= $item["evaluation"] ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>