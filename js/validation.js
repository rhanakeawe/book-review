// Client-side validation for signup page
// Uses JustValidate
// https://just-validate.dev/docs/intro

const validation = new JustValidate("#signup");

validation
    .addField("#name", [
        {
            rule: "required"
        }
    ])
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        { // Checks if email is taken in database
            validator: (value) => () => {
                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(json) {
                        return json.available;
                    });
            },
            errorMessage: "email already taken"
        }
    ])
    .addField("#street_address", [
        {
            rule: "required"
        }
    ])
    .addField("#phone_number", [
        {
            rule: "required"
        }
    ])
    .addField("#password", [
        {
            rule: "required"
        },
        {
            rule: "password"
        }
    ])

    // Checks if passwords match
    .addField("#password-confirmation", [
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords should match"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });