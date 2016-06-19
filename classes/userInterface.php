<?php

/**
 * Автор: Dragon
 * Дата: 10:40:16 10.06.2016
 */
class module_comment_classes_userInterface {

    private $_contructWithUser = null;
    private $_user = null;

    public function __construct($user = array()) {
        $this->_contructWithUser = !empty($user);
        $this->_user = $user;
    }

    public function __get($name) {
        switch ($name) {
            case 'image':
                if ($this->contructWithUser()) {
                    return $this->_user->image;
                }
                return '';
                break;
            case 'id':
                if ($this->contructWithUser()) {
                    return $this->_user->id;
                }
                return '';
                break;
            case 'name':
                if ($this->contructWithUser()) {
                    return $this->_user->name;
                }
                return 'Неизвестный пользователь';
                break;
            default:
                break;
        }
    }
    
    public function isAuth() {
        if($this->contructWithUser() && method_exists($this->_user, 'isAuth')) {
            return $this->_user->isAuth();
        }
        return false;
    }
    
    public function isOwner($userId) {
        if($this->contructWithUser() && method_exists($this->_user, 'isOwner')) {
            return $this->_user->isOwner($userId);
        }
        return false;
    }
    
    public function isCurrent() {
        if($this->contructWithUser() && method_exists($this->_user, 'isCurrent')) {
            return $this->_user->isCurrent();
        }
        return false;
    }
    
    public function hasUrl() {
        if($this->contructWithUser() && method_exists($this->_user, 'hasUrl')) {
            return $this->_user->hasUrl();
        }
        return false;
    }

    public function contructWithUser() {
        return $this->_contructWithUser;
    }

}
