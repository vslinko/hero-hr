var app = app || {};

(function () {
    'use strict';

    app.VacancyView = Backbone.View.extend({
        template: vacancy,
        templateVariable: 'vacancy'
    });

})();
