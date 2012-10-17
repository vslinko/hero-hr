var app = app || {};

(function () {
    'use strict';

    app.Vacancy = Backbone.Model.extend({
        url: Routing.generate('rithis_herohr_vacancy_all')
    });

})();
