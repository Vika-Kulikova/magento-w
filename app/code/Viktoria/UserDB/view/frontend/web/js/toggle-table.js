define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('userDB.switcherTable', {
        _create: function () {
            this.element.on('click', function () {
                $('.container-table').toggle('slow');
            });
        }
    });
    return $.userDB.switcherTable;
});