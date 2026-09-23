import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'media',

    theme: {
        extend: {
            fontFamily: {
                sans: [
                    '"Segoe UI Variable Text"',
                    '"Segoe UI"',
                    '-apple-system',
                    'BlinkMacSystemFont',
                    '"SF Pro Text"',
                    'system-ui',
                    'Roboto',
                    '"Helvetica Neue"',
                    'sans-serif',
                ],
            },

            colors: {
                // Neutres: mai blanc ni negre purs
                tinta: {
                    50: '#FAFAF9',
                    100: '#F3F3F2',
                    200: '#E6E6E4',
                    300: '#D2D2D0',
                    400: '#A2A2A0',
                    500: '#79797A',
                    600: '#57575A',
                    700: '#3B3B3E',
                    800: '#232326',
                    900: '#1D1D1F',
                    950: '#121214',
                },
                // Acent unic del projecte: blau pissarra
                acent: {
                    50: '#F1F6FA',
                    100: '#DFEAF3',
                    200: '#BFD4E7',
                    300: '#95B6D3',
                    400: '#6493BE',
                    500: '#3F76A6',
                    600: '#2F6090',
                    700: '#284E73',
                    800: '#24415D',
                    900: '#22384E',
                },
                estat: {
                    pendent: '#8F6200',
                    'pendent-fons': '#FAF0DC',
                    'pendent-clar': '#E0AC57',
                    curs: '#2F6090',
                    'curs-fons': '#E6EEF6',
                    'curs-clar': '#86AED0',
                    resolt: '#2C6B50',
                    'resolt-fons': '#E5EFE9',
                    'resolt-clar': '#73B092',
                },
                perill: {
                    600: '#9D3B32',
                    500: '#B4483E',
                    fons: '#F8EAE8',
                    clar: '#E2897F',
                },
            },

            borderRadius: {
                control: '8px',
                targeta: '12px',
                panell: '20px',
            },

            boxShadow: {
                suau: '0 1px 2px rgba(18, 18, 20, 0.04), 0 8px 24px -16px rgba(18, 18, 20, 0.18)',
                elevat: '0 2px 4px rgba(18, 18, 20, 0.05), 0 16px 40px -20px rgba(18, 18, 20, 0.28)',
            },

            transitionTimingFunction: {
                suau: 'cubic-bezier(0.22, 0.61, 0.36, 1)',
            },
        },
    },

    plugins: [forms],
};
