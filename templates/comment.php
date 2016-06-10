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
        <p>
            Сообщение оставленно <time datetime="<?= $comment->createDate ?>"><?= $comment->formatedDate ?></time> пользователем <?= $comment->user->name ?>.
        </p>
    </footer>
</article>
