import {
    extend
} from 'vee-validate';
import {
    required,
    email,
    min,
    numeric
} from 'vee-validate/dist/rules';
extend("required", required);
extend("email", email);
extend("numeric", numeric);
extend("min", min);

extend("decimal", {
    validate: (value, {
        decimals = "*",
        separator = "."
    } = {}) => {
        if (value === null || value === undefined || value === "") {
            return {
                valid: false
            };
        }
        if (Number(decimals) === 0) {
            return {
                valid: /^-?\d*$/.test(value)
            };
        }
        const regexPart = decimals === "*" ? "+" : `{1,${decimals}}`;
        const regex = new RegExp(
            `^[-+]?\\d*(\\${separator}\\d${regexPart})?([eE]{1}[-]?\\d+)?$`
        );
        return {
            valid: regex.test(value),
            data: {
                serverMessage: "Only decimal values are available"
            }
        };
    },
    message: "Please enter decimal or integer in this field"
})
