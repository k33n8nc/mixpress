module.exports = {
  content: [
    "./front-page.php",
    "./header.php",
    "./footer.php",
    "./page.php",
    "./page-abonnementen.php",
    "./archive-sfwd-courses.php",
    "./single-sfwd-courses.php",
    "./theme-functions/theme-menus.php",
    "./page-over-ons.php",
    "./page-esotherie.php",
    "./page-lessen.php",
    "./page-my-account.php",
    "./blocks/**/block.php",
    "./woocommerce/myaccount/dashboard.php",
  ],
  safelist: [],
  theme: {
    extend: {
      colors: {
        primary: "#1d73c3",
        secondary: "#0b2b3e",
      },
    },
  },
  corePlugins: {
    aspectRatio: false,
  },
  plugins: [require("@tailwindcss/aspect-ratio")],
};
