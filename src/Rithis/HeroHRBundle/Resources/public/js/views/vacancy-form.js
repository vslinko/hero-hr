var app = app || {};

(function () {
    'use strict';

    app.VacancyFormView = Backbone.View.extend({
        events: {
            'submit': "submit"
        },

        initialize: function () {
            this.$input = this.$('[data-vacancy-form-title]');
            this.$errors = this.$('[data-vacancy-form-errors]');
        },

        submit: function (e) {
            e.preventDefault();

            var vacancy = new app.Vacancy({
                title: this.$input.val()
            });

            var vacancyFormView = this;

            vacancy.save({}, {
                success: function (model) {
                    app.Vacancies.add(model);
                },
                error: function (model, response) {
                    // todo check for error type
                    vacancyFormView.setErrors(JSON.parse(response.responseText));
                }
            });
        },

        setErrors: function (errors) {
            var allErrors = [];
            var appendErrors = function (formErrors) {
                if (_.isArray(formErrors)) {
                    _.each(formErrors, function (error) {
                        allErrors.push({message: error});
                    });
                }
            };

            if (_.has(errors, "errors")) {
                appendErrors(errors.errors);
            }

            if (_.has(errors, "children") && _.has(errors.children, "title") && _.has(errors.children.title, "errors")) {
                appendErrors(errors.children.title.errors);
            }

            if (allErrors.length > 0) {
                this.$errors.html(Twig.render(window.errors, {errors: allErrors}));
            }
        }
    });

})();
