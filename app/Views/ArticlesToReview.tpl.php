<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded p-md-5 p-2 create-articel container">

        <h2 class="mb-5">Články k hodnocení</h2>

        <?php if(!isset($tplData["articles"]) || !$tplData["articles"]): ?>
            <h3>Nejsou zde žádné články</h3>
        <?php endif;?>

        <?php foreach ($tplData["articles"] as $key => $item): ?>
            <div class="card mb-4" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <a class="btn btn-success" target="_blank" href="<?= "uploads/".$item['document_name'] ?>"><i class="fa fa-floppy-o"></i> Stáhnout Článek</a>
                            <a class="btn btn-secondary mt-2" href="../../index.php?page=recenzovat&articel_id=<?= $item["id"] ?>"><i class="fa fa-pencil-square"></i> Recenzovat Článek</a>
                            <p class="card-text text-info"> <br> <span class="font-weight-bold"> <?= $item["author"] ?> </span> <br> <?= date("d.m. Y", strtotime( $item["publish_date"]))?></p>
                        </div>
                        <div class="col-md-9 col-12">
                            <h4 class="card-title font-italic mt-3 mt-md-0">
                                <a data-toggle="collapse" href="#a<?= $key ?>">
                                    <i class="fa fa-sort text-secondary" aria-hidden="true"></i>
                                    <?= $item["name"] ?>
                                </a>
                            </h4>
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
