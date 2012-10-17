var app = app || {};

(function () {
    'use strict';

    app.NavbarView = Backbone.View.extend({
        events: {
            'click [data-navbar-vacancies]': 'openAllVacancies'
        },

        openAllVacancies: function (e) {
            e.preventDefault();

            app.VacancyRouter.openAllVacancies();
        }
    });

})();
