<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded create-articel container p-md-5 p-2">

        <div class="row mb-5">
            <div class="col-12 col-md text-info font-weight-bold">
                <h4 class="text-center">
                    <i class="fa fa-question-circle"></i>
                    <br>
                    Recenzováno
                </h4>
            </div>
            <div class="col-12 col-md text-success font-weight-bold">
                <h4 class="text-center">
                    <i class="fa fa-check-circle"></i>
                    <br>
                    Akceptováno
                </h4>
            </div>
            <div class="col-12 col-md text-danger font-weight-bold">
                <h4 class="text-center">
                    <i class="fa fa-times-circle"></i>
                    <br>
                    Zamítnuto
                </h4>
            </div>
        </div>

        <?php foreach ($tplData["articles"] as $key => $item): ?>
            <?php
                $stateColor = "border-info";
                if($item["state"] === ACCEPTED){
                    $stateColor = "border-success";
                }
                else if($item["state"] === REJECTED){
                    $stateColor = "border-danger";
                }
            ?>
            <div class="card mb-4" >
                <div class="card-body border <?= $stateColor ?> rounded" style="border-width: thick!important;">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <h4 class="card-title font-italic"><?= $item["name"] ?></h4>
                            <a class="btn btn-success" target="_blank" href="<?= "uploads/".$item['document_name'] ?>"><i class="fa fa-floppy-o"></i> Stáhnout Článek</a>
                            <?php if($item["state"] === REVIEWED): ?>
                                <a class="btn btn-secondary text-white my-2" href="../../index.php?page=publikovat&id=<?= $item["id"] ?>"><i class="fa fa-pencil-square"></i> Upravit Článek</a>
                            <?php endif; ?>
                            <p class="card-text text-info"> <br> <?= date("d.m. Y", strtotime( $item["creation_date"]))?></p>
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
                    <?php if($item["state"] !== REVIEWED): ?>

                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <p class="card-text text-info"><?= date("d.m. Y", strtotime( $item["publish_date"]))?></p>
                            </div>
                            <div class="col-9">
                                <?php if($item["state"] === ACCEPTED): ?>
                                    <h4 class="text-success">
                                        <i class="fa fa-check-circle"></i>
                                        Akceptováno
                                    </h4>
                                <?php endif;?>
                                <?php if($item["state"] === REJECTED): ?>
                                    <h4 class="text-danger">
                                        <i class="fa fa-times-circle"></i>
                                        Zamítnuto
                                    </h4>
                                <?php endif;?>
                                <?= $item["evaluation"] ?>
                            </div>
                        </div>


                    <?php endif;?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>
