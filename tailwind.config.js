module.exports = {

    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',


    ],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [

      require('@tailwindcss/typography'),
      require('daisyui'),

  ],
}
