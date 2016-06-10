<?php
/** @var $session \yii\web\Session */
$session = Yii::$app->session;
?>

<?php if($session->hasFlash("success") || $session->hasFlash("error") || $session->hasFlash("warning")) : ?>
    
    <?php if($session->hasFlash("error")) : ?>

        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Erro!</h4><?= $session->getFlash("error") ?>
        </div>

    <?php elseif ($session->hasFlash("warning")) : ?>

        <div class="alert alert-warning" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Atenção!</h4><?= $session->getFlash("warning") ?>
        </div>

    <?php elseif ($session->hasFlash("success")) : ?>

        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Sucesso!</h4><?= $session->getFlash("success") ?>
        </div>

    <?php endif; ?>

<?php endif; ?>
