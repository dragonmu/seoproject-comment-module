<?php
/**
 * Автор: Dragon
 * Дата: 12:43:53 08.06.2016
 */
/* @var $this module_comment_controller */
?>

<section class="{_SITE_NAME_}-module-<?= $this->_code; ?>" data-moduleId="<?= $this->_entityId ?>">
    <h1>Комментарии</h1>
    <div class="addCommentForm">
        <form method="POST">
            <textarea name="modulecomment[comment]"></textarea>
            <input type="submit"/>
        </form>
    </div>
    <? include 'comments.php'; ?>
</section>