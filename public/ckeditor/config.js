/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 *
 * To be used in inline editors only.
 */

CKEDITOR.editorConfig = function (config) {
    config.forcePasteAsPlainText = true;
    config.toolbar = [
        {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        {name: 'editing', items: ['Scayt']},
        {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
        {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']},
        {name: 'document', items: ['Inlinesave']},
        '/',
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Strike', 'Underline', '-', 'Subscript', 'Superscript', '-', 'RemoveFormat']
        },
        {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']},
        {name: 'styles', items: ['Format']}
    ];
    config.inlinesave = {
        postUrl: postUrl,
        postData: {_token: token},
        onSuccess: function(editor, data) {
            console.log(data);
            data = $.parseJSON(data);
            if (data.success != true) {
                alert(data.content);
            }
            editor.focusManager.blur();
        },
    };
    config.enterMode = CKEDITOR.ENTER_BR;
    config.entities = false;
    config.htmlEncodeOutput = false;
};
