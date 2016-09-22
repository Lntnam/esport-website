/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    config.forcePasteAsPlainText = true;
    config.enterMode = CKEDITOR.ENTER_BR;
    config.entities = false;
    config.htmlEncodeOutput = false;
    config.extraPlugins = 'glyphicons';
    config.contentsCss = '../css/bootstrap.min.css';
    config.allowedContent = true;
    config.toolbar = [
        {name: 'document', items: ['Sourcedialog', '-', 'Inlinesave']},
        {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        {name: 'styles', items: ['Format', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        '/',
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        },
        {name: 'links', items: ['Link', 'Unlink']},
        {name: 'insert', items: ['Glyphicons']}
    ];
    config.inlinesave = {
        postUrl: postUrl,
        postData: {_token: token},
        onSuccess: function (editor, data) {
            console.log(data);
            data = $.parseJSON(data);
            if (data.success != true) {
                alert(data.content);
            }
            editor.focusManager.blur();
        },
    };
};
