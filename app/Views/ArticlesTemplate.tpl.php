<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded p-2 p-md-5 create-articel container">

        <?php foreach ($tplData["articles"] as $key => $item): ?>
            <div class="card mb-4" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <h4 class="card-title font-italic"><?= $item["name"] ?></h4>
                            <a class="btn btn-success" target="_blank" href="<?= "uploads/".$item['document_name'] ?>"><i class="fa fa-floppy-o"></i> Stáhnout Článek</a>
                            <p class="card-text text-info"> <br> <span class="font-weight-bold"> <?= $item["author"] ?> </span> <br> <?= date("d.m. Y", strtotime( $item["publish_date"]))?></p>
                        </div>
                        <div class="col-12 col-md-9">

                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#a<?= $key ?>">
                                    Abstrakt...
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
