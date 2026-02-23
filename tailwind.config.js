import defaultTheme from 'tailwindcss/defaultTheme';
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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Merriweather', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                // Violet Principal (Sophistiqué, profond)
                primary: {
                    50: '#f5f3ff',
                    100: '#ede9fe',
                    200: '#ddd6fe',
                    300: '#c4b5fd',
                    400: '#a78bfa',
                    500: '#8b5cf6',
                    600: '#7c3aed',
                    700: '#6d28d9',
                    800: '#5b21b6',
                    900: '#4c1d95',
                    950: '#2e1065',
                },
                // Accent: Un corail/rose doux pour contraster avec le violet et le blanc, apportant dynamisme
                accent: {
                    50: '#fff1f2',
                    100: '#ffe4e6',
                    200: '#fecdd3',
                    300: '#fda4af',
                    400: '#fb7185',
                    500: '#f43f5e',
                    600: '#e11d48',
                    700: '#be123c',
                    800: '#9f1239',
                    900: '#881337',
                    950: '#4c0519',
                },
                // Surface (Pour le mode clair pur et le mode sombre profond)
                surface: {
                    light: '#ffffff',
                    dark: '#0f172a', // Un slate très foncé pour un mode sombre élégant
                    darker: '#020617', // Fond principal en dark mode
                }
            },
            borderRadius: {
                // "Bords légèrement arrondis" (On privilégie du sm/md/lg mais pas de 'full' ou '3xl' massifs pour les conteneurs)
                'xl': '0.75rem',     // 12px
                '2xl': '1rem',       // 16px
            },
            boxShadow: {
                'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                'soft-dark': '0 4px 20px -2px rgba(0, 0, 0, 0.4)',
                'glow': '0 0 20px rgba(124, 58, 237, 0.15)', // Lueur violette
            }
        },
    },

    plugins: [forms, require('@tailwindcss/typography')],
};
