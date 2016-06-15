<?php

/**
 * Автор: Dragon
 * Дата: 12:44:41 08.06.2016
 */
/* @var $this module_comment_controller */
?>

<section class="{_SITE_NAME_}-module-<?= $this->_code; ?>" data-moduleId="<?= $this->_entityId ?>">
    <h1 class="commentHeader">Комментарии</h1>
    <? include 'comments.php'; ?>
</section>