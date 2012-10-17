var app = app || {};

(function () {
    'use strict';

    app.VacanciesView = Backbone.View.extend({
        template: vacancies,

        render: function () {
            this._render({
                vacancies: app.Vacancies.toJSON()
            });
        }
    });

})();
