Validation.add('validate-cpf', 'Invalid CPF.', function(value) {
    value = value.replace(/([^0-9]*)/g, '');

    if (value.length != 11) {
        return false;
    }

    var invalidValues = ['11111111111', '22222222222', '33333333333', '44444444444', '55555555555', '66666666666', '77777777777', '88888888888', '99999999999', '00000000000'];

    for (var index in invalidValues) {
        if (value == invalidValues[index]) {
            return false;
        }
    }

    for (t = 9; t < 11; t++) {
        for (d = 0, c = 0; c < t; c++) {
            d += value[c] * ((t + 1) - c);
        }

        d = ((10 * d) % 11) % 10;

        if (value[c] != d) {
            return false;
        }
    }

    return true;
});

Validation.add('validate-cnpj', 'Invalid CNPJ.', function(value) {
    value = value.replace(/([^0-9]*)/g, '');

    if (value.length != 15) {
        return false;
    }

    for (t = 13; t < 15; t++) {
        for (d = 0, p = t - 7, c = 0; c < t; c++) {
            d += value[c] * p;
            p = (p < 3) ? 9 : --p;
        }

        d = ((10 * d) % 11) % 10;

        if (value[c] != d) {
            return false;
        }
    }

    return true;
});

var Customer = Class.create();
Customer.prototype = {
    initialize: function(form, saveUrl) {
        this.form = form;

        if ($(this.form)) {
            $(this.form).observe('submit', function(event) {
                this.save();
                Event.stop(event);
            }.bind(this));
        }

        this.saveUrl = saveUrl;
        this.onSave = this.nextStep.bindAsEventListener(this);
        this.onComplete = this.resetLoadWaiting.bindAsEventListener(this);
    },
    save: function() {
        if (checkout.loadWaiting != false) {
            return;
        }

        var validator = new Validation(this.form);
        if (validator.validate()) {
            checkout.setLoadWaiting('customer');

            var request = new Ajax.Request(
                    this.saveUrl,
                    {
                        method: 'post',
                        onComplete: this.onComplete,
                        onSuccess: this.onSave,
                        onFailure: checkout.ajaxFailure.bind(checkout),
                        parameters: Form.serialize(this.form)
                    }
            );
        }
    },
    nextStep: function(transport) {
        if (transport && transport.responseText) {
            try {
                response = eval('(' + transport.responseText + ')');
            }
            catch (e) {
                response = {};
            }
        }

        if (response.error) {
            if ((typeof response.message) == 'string') {
                alert(response.message);
            } else {
                alert(response.message.join("\n"));
            }

            return false;
        }

        checkout.setStepResponse(response);
    },
    resetLoadWaiting: function(transport) {
        checkout.setLoadWaiting(false);
        document.body.fire('customer-request:completed', {transport: transport});
    }
};