<?php
/**
 * Автор: Dragon
 * Дата: 23:27:20 08.06.2016
 */
/* @var $this module_comment_controller */
/* @var $comment module_comment_classes_comment */
?>
<article class="comment" data-commentId="<?= $comment->id ?>">
    <p>
        <?= $comment->html ?>
    </p>
    <footer class="commentFooter">
        <? if ($this->_user->isAuth()) { ?>
            <fieldset>
                <? if ($this->_user->isOwner($comment->userId)) { ?>
                    <button class="deleteComment-Button" data-commentId="<?= $comment->id ?>">удалить</button>
                <? } else { ?>
                    <button class="replyComment-Button" data-commentId="<?= $comment->id ?>">Ответить</button>
                <? } ?>
            </fieldset>
        <? } ?>
        <? if ($comment->parentId && isset($this->comments[$comment->parentId])) { ?>
            <p class="commentReply">
                Ответ на комментарий пользователя <?= $this->comments[$comment->parentId]->user->name ?>
            </p>
        <? } ?>
        <p>
            Сообщение оставленно <time datetime="<?= $comment->createDate ?>"><?= $comment->formatedDate ?></time> пользователем <?= $comment->user->name ?>.
        </p>
    </footer>
</article>
