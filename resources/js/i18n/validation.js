export default {
    required: 'This field is required.',
    string: 'This field must be a string.',
    max: {
        string: 'This field may not be greater than :max characters.',
    },
    email: 'Please enter a valid email address.',
    min: {
        string: 'Password must be at least :min characters.',
    },
    regex: 'Password must include at least one lowercase letter, one uppercase letter, one number, and one special character (@$!%*#?&).',

    attributes: {
        firstName: 'first name',
        lastName: 'last name',
        email: 'email address',
        password: 'password',
    },
};
