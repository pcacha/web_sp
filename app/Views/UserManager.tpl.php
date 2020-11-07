<?php
global $tplData;

?>
<section>
    <div class="mx-auto mt-5 border rounded p-5 create-articel">

        <table class="table table-dark table-striped table-bordered table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">Jméno</th>
                <th scope="col">Datum Registrace</th>
                <th scope="col">Autor</th>
                <th scope="col">Recenzent</th>
                <th scope="col">Ban</th>
                <th scope="col">Smazat</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tplData["users"] as $item): ?>
                <tr>
                    <td><?= $item["name"] ?></td>
                    <td><?= date("d.m. Y", strtotime( $item["reg_date"]))?> </td>
                    <td>
                        <input data-myAut="<?= $item["id"] ?>" class="myAut" type="checkbox" <?php if($item["isAuthor"] == 1) echo("checked") ?>>
                    </td>
                    <td>
                        <input data-myRev="<?= $item["id"] ?>" class="myRev" type="checkbox" <?php if($item["isReviewer"] == 1) echo("checked") ?>>
                    </td>
                    <td>
                        <input data-myBan="<?= $item["id"] ?>" class="myBan" type="checkbox" <?php if($item["banned"] == 1) echo("checked") ?>>
                    </td>
                    <td>
                        <button data-myDel="<?= $item["id"] ?>"  class="btn btn-primary myDel">Smazat</button>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</section>
<script>
    let authCheckboxes = $('.myAut');
    $(authCheckboxes).click(function() {
        let value = ($(this).prop('checked')) ? 1 : 0;
        let url = "index.php?page=zpracujPozadavek&action=setAuthor&value="+value+"&id="+$(this).attr("data-myAut");
        fetch(url).then(res => {
            res.json().then(data => {
                if(!data){
                    let status = $(this).prop('checked');
                    $(this).prop('checked', !status);
                }
            });
        })
    });

    let revCheckboxes = $('.myRev');
    $(revCheckboxes).click(function() {
        let value = ($(this).prop('checked')) ? 1 : 0;
        let url = "index.php?page=zpracujPozadavek&action=setRev&value="+value+"&id="+$(this).attr("data-myRev");
        fetch(url).then(res => {
            res.json().then(data => {
                if(!data){
                    let status = $(this).prop('checked');
                    $(this).prop('checked', !status);
                }
            });
        })
    });

    let banCheckboxes = $('.myBan');
    $(banCheckboxes).click(function() {
        let value = ($(this).prop('checked')) ? 1 : 0;
        let url = "index.php?page=zpracujPozadavek&action=setBan&value="+value+"&id="+$(this).attr("data-myBan");
        fetch(url).then(res => {
            res.json().then(data => {
                if(!data){
                    let status = $(this).prop('checked');
                    $(this).prop('checked', !status);
                }
            });
        })
    });

    let deleteBtns = $('.myDel');
    $(deleteBtns).click(function() {
        let url = "index.php?page=zpracujPozadavek&action=delete&value=0&id="+$(this).attr("data-myDel");
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