define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('userDB.generateTable', {
        _create: function () {
            this.element.on('click', function () {
                $('.container-generation-table').toggle();
            });
        }
    });
    return $.userDB.generateTable;
});