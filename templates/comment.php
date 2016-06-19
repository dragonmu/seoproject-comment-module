<?php
/**
 * Автор: Dragon
 * Дата: 23:27:20 08.06.2016
 */
/* @var $this module_comment_controller */
/* @var $comment module_comment_classes_comment */
?>
<article class="comment" data-commentId="<?= $comment->id ?>">
    <header class="commentHeader">
        <address class="commentAuthor">
            <? if ($comment->user->hasUrl()) { ?>
                <a rel="author" class="commentAuthorAvatar" style="background-image: url(<?= $comment->user->image ?>);" href="<?= $comment->user->url ?>"><?= $comment->user->name ?></a>
            <? } else { ?>
                <span class="commentAuthorAvatar"><?= $comment->user->name ?></span>
            <? } ?>
        </address>
    </header>
    <p><?=  strip_tags($comment->html) ?></p>
    <footer class="commentFooter">

        <fieldset>
            <? if ($this->_user->isOwner($comment->userId)) { ?>
                <button class="deleteComment-Button" data-commentId="<?= $comment->id ?>">удалить</button>
            <? } else { ?>
                <? if ($this->_user->isAuth()) { ?>
                    <button class="replyComment-Button" data-commentId="<?= $comment->id ?>">Ответить</button>
                <? } else { ?>
                    <div class="replyComment-Button" onclick="<?= $this->needAuthHtml ?>">Ответить</div>
                <? } ?>
            <? } ?>
        </fieldset>

        <? if ($comment->parentId && isset($this->comments[$comment->parentId])) { ?>
            <p class="commentReply">Ответ на комментарий пользователя <span class="commentReplyName"><?= $this->comments[$comment->parentId]->user->name ?></span></p>
        <? } ?>
        <p>Сообщение оставленно <time datetime="<?= $comment->createDate ?>"><?= $comment->formatedDate ?></time> пользователем <span class="commentOwnerName"><?= $comment->user->name ?></span>.</p>
    </footer>
</article>
