<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded p-5 create-articel">

        <?php foreach ($tplData["reviews"] as $item): ?>
            <div class="card mb-4" >
                <div class="card-body border rounded">
                    <div class="row">
                        <div class="col-3">
                            <h4 class="card-title font-italic"><?= $item["articel_name"] ?></h4>
                            <p class="card-text text-info"> <?=  $item["articel_author"] ?></p>

                            <?php if($item["articel_state"] == 1): ?>
                                <a class="btn btn-secondary text-white my-2" href="../../index.php?page=recenzovat&articel_id=<?= $item["articel_id"] ?>&review_id=<?= $item["review_id"] ?>"><i class="fa fa-pencil-square"></i> Upravit Recenzi</a>
                            <?php endif; ?>

                        </div>

                        <div class="col-9">
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
                            <p class="mt-3">
                                <?= $item["evaluation"] ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>
