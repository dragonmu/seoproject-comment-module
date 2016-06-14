# seoproject-comment-module
Модуль комментариев к моему закрытому проекту.

### Использование модуля

```
$commentModule = parts_modulefabrica::a()->createModule('comment', array(
                'user' => parts_user::current()
                , 'userFactory' => factory_user::a()
                , 'db' => parts_sql::a()
                , 'entityId' => $this->_code . $this->_moduleId));
```

### Требование к классам

* userFactory - getById();
* user - name;
* user - isAuth();
* user - isCurrent();
* user - isOwner();
* db - getAll();
