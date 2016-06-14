<?php

/**
 * Автор: Dragon
 * Дата: 12:14:10 09.06.2016
 */
class module_comment_classes_comment {

    private $_user = null;
    public $monthRus = array(
        "01" => "января",
        "02" => "февраля",
        "03" => "марта",
        "04" => "апреля",
        "05" => "мая",
        "06" => "июня",
        "07" => "июля",
        "08" => "августа",
        "09" => "сентября",
        "10" => "октября",
        "11" => "ноября",
        "12" => "декабря");
    private $_commentData = array();

    public function __construct($row) {
        $this->_commentData = $row;
    }

    public function __get($name) {
        switch ($name) {
            case 'user':
                if (!empty($this->_user)) {
                    return $this->_user;
                }
                if (!empty($this->_commentData['userFactory'])) {
                    $this->_user = $this->_commentData['userFactory']->getById($this->_commentData['modulecomment_user_id']);
                } else {
                    $this->_user = new module_comment_classes_userInterface();
                }
                return $this->_user;
                break;
            case 'createDate':
                return $this->_commentData['modulecomment_createdate'];
                break;
            case 'formatedDate':
                $time = strtotime($this->_commentData['modulecomment_createdate']);
                return date('j ', $time) . $this->monthRus[date('m', $time)];
                break;
            case 'userId':
                $name = 'user_id';
            default:
                if (isset($this->_commentData['modulecomment_' . $name])) {
                    return $this->_commentData['modulecomment_' . $name];
                }
                if (isset($this->_commentData[$name])) {
                    return $this->_commentData[$name];
                }
                break;
        }
        return null;
    }

    public function __isset($name) {
        return is_null($this->$name);
    }

}
