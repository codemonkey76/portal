const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    variants: {
        extend: {
            borderStyle: ['hover']
        }
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                asg: {
                    default: '#80699d',
                    dark: '#793386',
                    '300': '#a283c7',
                    '400': '#8d72ad',
                    '500': '#80699d',
                    '600': '#6f588c',
                    '700': '#4e3a66'
                }
            },
            borderStyle: ['hover'],
            spacing: {
                '128': '32rem'
            }
        },
    },
    purge: false,
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
