import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [
                    'Inter',
                    '"Segoe UI Variable Text"',
                    '-apple-system',
                    'BlinkMacSystemFont',
                    '"SF Pro Text"',
                    '"Segoe UI"',
                    'system-ui',
                    'Roboto',
                    'sans-serif',
                ],
            },

            // Nada baja de 14 px. La escala sube con razon 1,2 a partir de ahi.
            fontSize: {
                xs: ['0.875rem', { lineHeight: '1.45' }],
                sm: ['0.9375rem', { lineHeight: '1.5' }],
                base: ['1rem', { lineHeight: '1.6' }],
                lg: ['1.125rem', { lineHeight: '1.4' }],
                xl: ['1.375rem', { lineHeight: '1.3' }],
                '2xl': ['1.75rem', { lineHeight: '1.2' }],
                '3xl': ['2.25rem', { lineHeight: '1.1' }],
            },

            colors: {
                // Grafito. Ni negro puro ni el mismo negro del portafolio: este tira a
                // calido, que es lo que pide el ambar encima.
                fons: {
                    DEFAULT: '#101012',
                    2: '#16161A',
                    3: '#1C1C21',
                    4: '#232329',
                },
                linia: {
                    DEFAULT: '#2B2B32',
                    suau: '#212127',
                },
                tinta: {
                    DEFAULT: '#F4F4F6',
                    2: '#A6A6AE',
                    3: '#84848E',
                },

                // Acento unico: ambar. Lenguaje de aviso y de mantenimiento.
                ambre: {
                    DEFAULT: '#E8A33D',
                    clar: '#F2C179',
                    fosc: '#B87A1E',
                    fons: '#2C1F0B',
                },
                'sobre-ambre': '#1A1205',

                // Los tres estados. Pendiente se queda con el acento a proposito: es lo
                // que hay que atender. Los otros dos van desaturados para no competir.
                estat: {
                    pendent: '#E8A33D',
                    'pendent-fons': '#2C1F0B',
                    curs: '#8FB0CC',
                    'curs-fons': '#182129',
                    resolt: '#7BB894',
                    'resolt-fons': '#16241D',
                },

                perill: {
                    DEFAULT: '#E2867C',
                    fosc: '#8E3931',
                    fons: '#2A1512',
                },
            },

            borderRadius: {
                control: '8px',
                targeta: '12px',
                panell: '20px',
            },

            boxShadow: {
                suau: '0 1px 2px rgba(0, 0, 0, 0.35)',
                elevat: '0 2px 6px rgba(0, 0, 0, 0.4), 0 24px 48px -24px rgba(0, 0, 0, 0.7)',
            },

            transitionTimingFunction: {
                suau: 'cubic-bezier(0.22, 0.61, 0.36, 1)',
            },

            maxWidth: {
                lectura: '68ch',
            },
        },
    },

    plugins: [forms],
};
