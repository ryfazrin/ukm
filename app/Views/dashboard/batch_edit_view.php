<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi Edit View</title>
</head>
<body>
    <form action="<?= base_url('dashboard-update/batch-update') ?>" method="post">
        <?php foreach ($dashboards as $dash): ?>
            <div>
                <input type="text" name="id" value="<?= $dash['id']?>" hidden>
                <label for="visi_[<?= $dash['id']?>]">Visi <?=$dash['id']?></label>
                <input type="text" name="visi_[<?= $dash['id']?>]" value="<?= $dash['visi']?>">
            </div>
        <?php endforeach; ?>
         <button type="submit">update data</button>
    </form>
</body>
</html>