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
              followed_by: "#9F2B68",
          },
          margin: {
              '3px': '3px',
          }
      },
      fontSize: {
          xxs: '0.6rem',
          xs: '0.75rem',
          sm: '0.875rem',
          base: '1rem',
          xl: '1.25rem',
          '2xl': '1.5rem',
          '3xl': '1.875rem',
          '4xl': '2.25rem',
          '5xl': '3.75rem',
      },
  },
    plugins: [require("tw-elements/plugin.cjs")],
}

