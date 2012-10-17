var app = app || {};

(function () {
    'use strict';

    app.VacancyPreviewView = Backbone.View.extend({
        events: {
            'click [data-vacancy-preview-open]': "open"
        },

        open: function (e) {
            e.preventDefault();

            app.VacancyRouter.openVacancy(this.model);
        }
    });

})();
