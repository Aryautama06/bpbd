/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'bpbd': {
                    primary: '#E63946',
                    secondary: '#1D3557',
                    accent: '#457B9D',
                    light: '#F1FAEE',
                    dark: '#1D3557'
                }
            },
            fontFamily: {
                'sans': ['Inter', 'system-ui', 'sans-serif'],
                'heading': ['Plus Jakarta Sans', 'system-ui', 'sans-serif']
            }
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}