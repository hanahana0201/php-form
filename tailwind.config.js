/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./form.php"],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

