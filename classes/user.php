<?php

/**
 * Автор: Dragon
 * Дата: 10:40:16 10.06.2016
 */
class module_comment_classes_user {
    
    public function __get($name) {
        switch ($name) {
            case 'name':
                return 'Неизвестный пользователь';
                break;
            default:
                break;
        }
    }
}
