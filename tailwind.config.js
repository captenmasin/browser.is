const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')
const colorVariable = require('@mertasan/tailwindcss-variables/colorVariable')

const primary = '#000'
const primaryLight = '#202020'
const secondary = '#0000FF'
const tertiary = '#FFFFFF'
const borderRadius = '0.75rem'

module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        variables: {
            DEFAULT: {
                colors: {
                    primary: primary,
                    black: '#000000',
                    white: '#FFFFFF',
                    'primary-light': primaryLight,
                    secondary: secondary,
                    tertiary: tertiary,
                },
                'border-radius': {
                    md: '0.45rem',
                    default: borderRadius,
                    '4xl': '2rem'
                }
            }
        },
        extend: {
            fontSize: {
                '7xl': '4rem',
                '10xl': '6rem'
            },
            borderRadius: {
                default: 'var(--border-radius-default)',
                '4xl': '2rem'
            },
            colors: {
                gray: colors.slate,
                primary: {
                    DEFAULT: colorVariable('--colors-primary')
                },
                'primary-light': {
                    DEFAULT: colorVariable('--colors-primary-light')
                },
                secondary: {
                    DEFAULT: colorVariable('--colors-secondary')
                },
                tertiary: {
                    DEFAULT: colorVariable('--colors-tertiary')
                }
            },
            fontFamily: {
                heading: [
                    'Escalator',
                    'Inter',
                    'ui-sans-serif',
                    'system-ui',
                    '-apple-system',
                    'BlinkMacSystemFont',
                    'sans-serif'
                ],
                body: ['ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                system: ['ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@mertasan/tailwindcss-variables')({
            colorVariables: true
        }),
    ],
}
