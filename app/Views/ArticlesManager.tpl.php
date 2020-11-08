<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded p-md-5 p-2 container create-articel">

        <?php foreach ($tplData["articles"] as $key => $item): ?>
            <div class="card mb-4" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <h4 class="card-title font-italic"><?= $item["name"] ?></h4>
                            <a class="btn btn-success" target="_blank" href="<?= "uploads/".$item['document_name'] ?>"><i class="fa fa-floppy-o"></i> Stáhnout Článek</a>
                            <a class="btn btn-secondary my-2" href="../../index.php?page=showReviews&articel_id=<?= $item['id'] ?>"><i class="fa fa-comments"></i> Recenze Článku</a>
                            <a class="btn btn-secondary" href="../../index.php?page=decide&articel_id=<?= $item['id'] ?>"><i class="fa fa-paper-plane"></i> Rozhodnout</a>
                            <p class="card-text text-info"> <br> <span class="font-weight-bold"> <?= $item["author"] ?> </span> <br> <?= date("d.m. Y", strtotime( $item["creation_date"]))?></p>
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
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h4>Přidat recenzenty:</h4>

                            <table class="table table-dark table-striped table-bordered table-hover">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Jméno</th>
                                    <th scope="col">Přidat</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($item["posRevs"] as $reviewer): ?>
                                    <tr>
                                        <td><?= $reviewer["user_name"] ?></td>
                                        <td>
                                            <button data-userId="<?= $reviewer["user_id"]?>" data-articelId="<?= $reviewer["articel_id"] ?>"  class="btn btn-primary myAdd">Přidat</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>

<script>
    let addBtns = $('.myAdd');
    $(addBtns).click(function() {
        let url = "index.php?page=zpracujPrirazeni&user_id=" + $(this).attr("data-userId")+ "&articel_id="+$(this).attr("data-articelId");
        fetch(url).then(res => {
            res.json().then(data => {
                if(data){
                    let tr = $(this).closest("tr");
                    $(tr).remove();
                }
            });
        })
    });
</script>