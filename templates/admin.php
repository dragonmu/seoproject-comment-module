<?php

/**
 * Автор: Dragon
 * Дата: 12:43:59 08.06.2016
 */
/* @var $this module_comment_controller */
?>
<article class="<?= $this->_siteName ?>-module-<?= $this->_code; ?>-add admin-container">
    <h4><?= $this->_name; ?></h4>
    <div class="<?= $this->_siteName ?>-module-<?= $this->_code; ?>-add-moduleDataEditForm" data-expandable="true">
        <h5>Форма редактирования данных модуля <?= $this->_name; ?></h5>
        <form method="POST" data-expandable="content">
            <input type="submit"/>
        </form>
    </div>
</article>