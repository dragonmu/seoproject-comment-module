<?php
/**
 * Автор: Dragon
 * Дата: 12:43:53 08.06.2016
 */
/* @var $this module_comment_controller */
?>

<section class="{_SITE_NAME_}-module-<?= $this->_code; ?>" data-moduleId="<?= $this->_entityId ?>">
    <h1 class="commentHeader">Комментарии</h1>
    <div class="addCommentForm">
        <form class="addCommentForm-Form" method="POST">
            <input type="hidden" class="addCommentForm-InputAjax" value="1" name="modulecomment<?= $this->_entityId ?>[ajax]"/>
            <textarea name="modulecomment<?= $this->_entityId ?>[comment]"></textarea>
            <input class="submitComment" type="submit" value="Отправить"/>
            <input class="cancelComment" type="button" value="Отменить"/>
        </form>
    </div>
    <? include 'comments.php'; ?>
</section>