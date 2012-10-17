var app = app || {};

(function () {
    'use strict';

    var Router = Backbone.Router.extend({
        routes: {
            "vacancies/": "openAllVacancies",
            "vacancies/:slug": "openVacancyBySlug"
        },

        initialize: function () {
            app.Vacancies.on('add', this.openVacancy, this);
        },

        openAllVacancies: function () {
            var router = this;

            app.Vacancies.fetch({
                success: function () {
                    router.navigate(Routing.generate('rithis_herohr_vacancy_all'));

                    app.contentView.setView(new app.VacanciesView());
                    app.reloadViews();
                },
                error: function () {
                    window.location.href = Routing.generate('rithis_herohr_vacancy_all');
                }
            });
        },

        openVacancyBySlug: function (slug) {
            var vacancy = _.first(app.Vacancies.where({slug: slug}));

            this.openVacancy(vacancy);
        },

        openVacancy: function (vacancy) {
            var url = Routing.generate('rithis_herohr_vacancy_get', {slug: vacancy.get('slug')});
            this.navigate(url);

            app.contentView.setView(new app.VacancyView({
                model: vacancy
            }));
        }
    });

    app.VacancyRouter = new Router();

})();
