const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      './storage/framework/views/*.php',
      './resources/views/*.blade.php',
      './resources/views/**/*.blade.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

