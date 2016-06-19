<?php
/**
 * Автор: Dragon
 * Дата: 12:44:41 08.06.2016
 */
/* @var $this module_comment_controller */
?>

<section class="<?= $this->_siteName ?>-module-<?= $this->_code; ?>" data-moduleId="<?= $this->_entityId ?>">
    <div class="addCommentHeader">Комментарии</div>
    <div class="addCommentForm">
        <div class="addCommentForm-Form" onclick="<?=$this->needAuthHtml?>">
            <textarea name="modulecomment<?= $this->_entityId ?>[comment]"></textarea>
            <input class="submitComment" type="submit" value="Отправить"/>
            <input class="cancelComment" type="button" value="Отменить"/>
        </div>
    </div>
    <? include 'comments.php'; ?>
</section>