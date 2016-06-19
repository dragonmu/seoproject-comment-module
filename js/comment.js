//_ENTITY_ID_ id сущности для которой блок комментариев, 2 на странице одинаковых быть не должно
Site.addEvent('loadCommentModule', function () {
    var commentModule = $('section[data-moduleId="_ENTITY_ID_"]');
    
    var init__ENTITY_ID_ = function () {
        var addCommentForm = $(commentModule).find('.addCommentForm-Form');
        var header = $(commentModule).find('.addCommentHeader');
        var submitButton = $(commentModule).find('.submitComment');
        var cancelButton = $(commentModule).find('.cancelComment');
        var deleteButton = $(commentModule).find('.deleteComment-Button');
        var replyButton = $(commentModule).find('.replyComment-Button');

        $(cancelButton).click(function(e){
            e.preventDefault();
            $(addCommentForm).detach();
            $(header).after($(addCommentForm));
            $(addCommentForm).find('.addCommentForm-InputParent').remove();
        });
        $(submitButton).click(function (e) {
            e.preventDefault();
            $.post('', $(addCommentForm).serialize(), function (result) {
                updateHtml__ENTITY_ID_(result);
            });
        });
        $(deleteButton).click(function (e) {
            $.post('', {modulecomment_ENTITY_ID_: {deleteId: $(this).attr('data-commentId')}}, function (result) {
                updateHtml__ENTITY_ID_(result);
            });
        });
        $(replyButton).click(function (e) {
            $(addCommentForm).detach();
            $(this).parents('article:first').append($(addCommentForm));
            var commentId = $(this).attr('data-commentId');
            $(addCommentForm).find('.addCommentForm-InputAjax').after('<input type="hidden" class="addCommentForm-InputParent" value="'+commentId+'" name="modulecomment_ENTITY_ID_[parentId]"/>');
        });
        console.log('init comments _ENTITY_ID_');
    };
    
    var updateHtml__ENTITY_ID_ = function (html) {
        var newComments = $(html).find('section[data-moduleId="_ENTITY_ID_"]');
        if (newComments.length === 1) {
            commentModule.html($(newComments).html());
            init__ENTITY_ID_();
        }
    }
    
    init__ENTITY_ID_();
    console.log('work comments _ENTITY_ID_');
});

