/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./*.php', './template-parts/**/*.php', './assets/js/**/*.js'],
  theme: {
    extend: {
      colors: {
        olive: '#74765D',
        'olive-dark': '#484B3B',
        cream: '#F5F0E8',
        offwhite: '#FBF8F2',
        beige: '#DED3C5',
        sand: '#E9E1D6',
        brown: '#776A5B',
        ink: '#36332E'
      },
      fontFamily: {
        display: ['Inter', 'sans-serif'],
        sans: ['Inter', 'sans-serif']
      }
    }
  },
  plugins: []
};
