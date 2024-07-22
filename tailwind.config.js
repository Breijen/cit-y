/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/tw-elements/js/**/*.js"
    ],
  theme: {
      extend: {
          colors: {
              content_bg: "#212121",
              background: "#080C0C",
              divider: "#303436",
              selected: "#E2CFEA",
              icons: "#3A3E41",
              placeholder: "#60676C",
          },
          margin: {
              '3px': '3px',
          }
      },
  },
    plugins: [require("tw-elements/plugin.cjs")],
}

