var app = app || {};

(function () {
    'use strict';

    var VacancyList = Backbone.Collection.extend({
        model: app.Vacancy,
        url: Routing.generate('rithis_herohr_vacancy_all'),
        sync: Backbone.cachingSync(Backbone.sync, 'app.Vacancies', 5)
    });

    app.Vacancies = new VacancyList();

})();
