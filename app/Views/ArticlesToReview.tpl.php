<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded p-5 create-articel">

        <?php foreach ($tplData["articles"] as $key => $item): ?>
            <div class="card mb-4" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <h4 class="card-title font-italic"><?= $item["name"] ?></h4>
                            <a class="btn btn-success" target="_blank" href="<?= "uploads/".$item['document_name'] ?>"><i class="fa fa-floppy-o"></i> Stáhnout Článek</a>
                            <a class="btn btn-secondary mt-2" href="../../index.php?page=recenzovat&articel_id=<?= $item["id"] ?>"><i class="fa fa-pencil-square"></i> Recenzovat Článek</a>
                            <p class="card-text text-info"> <br> <span class="font-weight-bold"> <?= $item["author"] ?> </span> <br> <?= date("d.m. Y", strtotime( $item["publish_date"]))?></p>
                        </div>
                        <div class="col-9">

                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#a<?= $key ?>">
                                    <div>
                                        <?php echo(strlen($item["abstract"]) > 100 ? substr($item["abstract"], 0, 97)."..." : $item["abstract"]); ?>
                                    </div>
                                </a>
                            </h5>
                            <div id="a<?= $key ?>" class="collapse">
                                <?= $item["abstract"] ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>