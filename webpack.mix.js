const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");

mix
  .options({
    postCss: [tailwindcss("./tailwind.config.js")],
    publicPath: "./",
    processCssUrls: false,
  })
  .js("resources/js/app.js", "assets/js")
  .sass("resources/scss/app.scss", "assets/css")
  .copyDirectory("resources/images", "assets/images")
  // .copyDirectory("resources/fonts", "assets/fonts")
  .version();

// Laravel mix image-min geinstalleerd zie node_modules en documentation
// Voor nu Standaard Laravel mix copy function gebruikt.

// Font awesome free geinstalleerd zie node_modules en docs
// Specific icons only = goal
// Voor nu heb ik via Wordpress de Font Awesome plugin gebruikt via CDN.
