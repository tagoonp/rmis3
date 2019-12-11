
Can't get rid of the auto-height
I installed a bunch of modules and though I've removed them from the configs and cleared my browser cache, as well as used different browsers that hadn't yet loaded the editor, AUTOHEIGHT is still enabled.  Not sure what I'm doing wrong.

Thanks for any advice.

-----------------------------------------------------------------------

config.js

/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here.
    // For the complete reference:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for a single toolbar row.
    config.toolbarGroups = [
        { name: 'document',       groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
        { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
        { name: 'forms' },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
        { name: 'links' },
        { name: 'insert' },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'tools' },
        { name: 'others' }
    ];

// ,
//        { name: 'about' }

    // The default plugins included in the basic setup define some buttons that
    // we don't want too have in a basic editor. We remove them here.
    config.removeButtons = 'Anchor,Underline,Subscript,Superscript';

    // Considering that the basic setup doesn't provide pasting cleanup features,
    // it's recommended to force everything to be plain text.
    config.forcePasteAsPlainText = false;

    // Let's have it basic on dialogs as well.
    config.removeDialogTabs = 'link:advanced';
};


--------------------------------------------------------------------

build-config.js


/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

/**
 * This file was added automatically by CKEditor builder.
 * You may re-use it at any time at http://ckeditor.com/builder to build CKEditor again.
 *
 * NOTE:
 *    This file is not used by CKEditor, you may remove it.
 *    Changing this file will not change your CKEditor configuration.
 */

var CKBUILDER_CONFIG = {
    skin: 'moono',
    preset: 'basic',
    ignore: [
        'dev',
        '.gitignore',
        '.gitattributes',
        'README.md',
        '.mailmap'
    ],
    plugins : {
        'basicstyles' : 1,
        'clipboard' : 1,
        'toolbar' : 1,
        'enterkey' : 1,
        'floatingspace' : 1,
        'indent' : 1,
        'link' : 1,
        'list' : 1,
        'pastetext' : 1,
        'undo' : 1,
        'dialog' : 1,
        'dialogui' : 1,
        'button' : 1,
        'fakeobjects' : 1,
        'blockquote' : 1,
        'panelbutton' : 1,
        'panel' : 1,
        'floatpanel' : 1,
        'colorbutton' : 1,
        'colordialog' : 1,
        'templates' : 1,
        'menu' : 1,
        'contextmenu' : 1,
        'div' : 1,
        'divarea' : 1,
        'resize' : 1,
        'find' : 1,
        'listblock' : 1,
        'richcombo' : 1,
        'format' : 1,
        'image' : 1,
        'symbol' : 1,
        'justify' : 1,
        'magicline' : 1,
        'liststyle' : 1,
        'pastefromword' : 1,
        'removeformat' : 1,
        'selectall' : 1,
        'showblocks' : 1,
        'showborders' : 1,
        'sourcearea' : 1,
        'menubutton' : 1,
        'scayt' : 1,
        'stylescombo' : 1,
        'stylesheetparser' : 1,
        'tab' : 1,
        'table' : 1,
        'tabletools' : 1,
        'tableresize' : 1,
        'wordcount' : 1,
        'horizontalrule' : 1,
        'popup' : 1,
        'elementspath' : 1
    },
    languages : {
        'en' : 1,
    }
};
