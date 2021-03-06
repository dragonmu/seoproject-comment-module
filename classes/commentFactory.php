<?php

/**
 * Автор: Dragon
 * Дата: 12:17:31 09.06.2016
 */
class module_comment_classes_commentFactory {

    private $_dbTable = 'modulecomment';
    protected $_moduleData = null;
    static $_instance = null;

    /**
     * @param type $moduleData
     * @return module_comment_classes_commentFactory
     */
    static function a($moduleData = array()) {
        $class = get_called_class();
        if (empty(self::$_instance)) {
            self::$_instance = new $class($moduleData);
        }
        return self::$_instance;
    }

    public function __construct($data) {
        $this->_moduleData = $data;
    }

    public function __get($name) {
        switch ($name) {
            case '_entityId':
            case '_userFactory':
            case '_user':
            case '_db':
                $name = str_replace('_', '', $name);
                return $this->_moduleData[$name];
                break;
            default:
                return (empty($this->_moduleData[$this->_dbTable . '_' . $name]) ? null : $this->_moduleData[$this->_dbTable . '_' . $name]);
                break;
        }
    }

    public function getAllByEntity($entityId) {
        $rows = $this->_db->getAll('select * from ' . $this->_dbTable . ' where ' . $this->_dbTable . '_entity_id=?s and ' . $this->_dbTable . '_active=1'
                , $entityId);
        return $this->getClassList($rows);
    }

    public function getById($commentId) {
        $row = $this->_db->getRow('select * from ' . $this->_dbTable . ' where ' . $this->_dbTable . '_id=?i'
                , (int) $commentId);
        return $this->getClass($row);
    }

    public function removeById($commentId) {
        $this->_db->getRow('update ' . $this->_dbTable . ' set ' . $this->_dbTable . '_active=0 where ' . $this->_dbTable . '_id=?i'
                , (int) $commentId);
    }

    public function getClassList($rows) {
        $classArray = array();
        foreach ($rows as $row) {
            $classArray[$row[$this->_dbTable . '_id']] = $this->getClass($row);
        }
        return $classArray;
    }

    public function getClass($row) {
        $row['userFactory'] = $this->_userFactory;
        return new module_comment_classes_comment($row);
    }

}
