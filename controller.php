<?php

/**
 * Автор: Dragon
 * Дата: 12:11:09 08.06.2016
 * @property type $_user экземпляр класса пользователя
 * @property string $_userFactory класс который может получить классы пользователей по id
 * @property type $_db экземпляр класса базы данных
 * @property string $_entityId уникальный идентификатор сущности к которой комментарии
 */
class module_comment_controller {

    protected $templateDir = 'templates/';
    protected $jsDir = 'js/';
    protected $_moduleData = null;
    protected $_contentData = null;
    protected $_name = 'Модуль комментариев';
    private $_dbTable = 'modulecomment';

    /**
     * Конструктор сайта
     * @param type $module
     */
    public function __construct($module = array()) {
        $this->_moduleData = $module;
        $this->_moduleData['user'] = (isset($module['user'])) ? new module_comment_classes_userInterface($module['user']) : new module_comment_classes_userInterface();
        //Инициализируем фабрику комментариев
        module_comment_classes_commentFactory::a($module);
        if ($this->_user->isAuth()) {
            if (!empty($_REQUEST['modulecomment' . $this->_entityId])) {
                $this->addNewComment($_REQUEST['modulecomment' . $this->_entityId]);
                $this->deleteComment($_REQUEST['modulecomment' . $this->_entityId]);
            }
        }
    }

    /**
     * загрузить контент для людей
     * @return type
     */
    public function loadContent() {
        if ($this->_user->isAuth()) {
            $js = $this->templateJs('comment');
            return $js . $this->template('autheduser');
        }
        return $this->template('user');
    }

    /**
     * загрузить контент для админа
     * @return type
     */
    public function loadAdminContent() {
        return $this->template('admin');
    }

    /**
     * Получаем шаблон
     * @param type $template
     * @return type
     */
    public function template($template) {
        ob_start();
        require $this->templateDir . $template . '.php';
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }

    public function templateJs($file) {
        ob_start();
        require $this->jsDir . $file . '.min.js';
        $result = ob_get_contents();
        ob_end_clean();
        $result = str_replace('_ENTITY_ID_', $this->_entityId, $result);
        return '<script>' . $result . '</script>';
    }

    /**
     * Возвращает имя модуля
     * @return type
     */
    public function getModuleName() {
        return $this->_name;
    }

    /**
     * Возвращает код модуля
     * @return type
     */
    public function getModuleCode() {
        return '';
    }

    public function addNewComment($formData) {
        $commentHtml = (isset($formData['comment']) ? $formData['comment'] : '');
        $commentHtml = trim($commentHtml);
        $parentId = (isset($formData['parentId']) ? $formData['parentId'] : null);

        if (empty($commentHtml)) {
            return;
        }

        $newComment = $this->_db->query('insert into ' . $this->_dbTable . ' (' .
                $this->_dbTable . '_parent_id,' .
                $this->_dbTable . '_entity_id,' .
                $this->_dbTable . '_user_id,' .
                $this->_dbTable . '_html) values (?i,?s,?i,?s)'
                , $parentId
                , $this->_entityId
                , $this->_user->id
                , $commentHtml);

        if ($newComment && empty($formData['ajax'])) {
            header("Location: $_SERVER[REQUEST_URI]");
            die();
        }
    }

    public function deleteComment($formData) {
        if (empty($formData['deleteId'])) {
            return;
        }

        $comment = module_comment_classes_commentFactory::a()->getById($formData['deleteId']);
        if ($this->_user->isOwner($comment->userId)) {
            module_comment_classes_commentFactory::a()->removeById($formData['deleteId']);
        }

        if ($newComment && empty($formData['ajax'])) {
            header("Location: $_SERVER[REQUEST_URI]");
            die();
        }
    }

    /**
     * Возвращает значения свойств
     * @param type $name
     * @return type
     */
    public function __get($name) {
        switch ($name) {
            case '_entityId':
            case '_userFactory':
            case '_user':
            case '_db':
                $name = str_replace('_', '', $name);
                return $this->_moduleData[$name];
                break;
            case 'moduleData':
                return $this->_moduleData;
                break;
            case 'comments':
                return module_comment_classes_commentFactory::a()->getAllByEntity($this->_entityId);
                break;
            case 'active':
                return (empty($this->_moduleData['modules_active']) ? false : $this->_moduleData['modules_active']);
            default:
                return (empty($this->_moduleData[$this->_dbTable . '_' . $name]) ? null : $this->_moduleData[$this->_dbTable . '_' . $name]);
                break;
        }
    }

    public function __isset($name) {
        return $this->$name != null;
    }

}
