const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig(webpack => {
  return {
    module: {
      rules: [
        {
          test: require.resolve("graphology"),
          loader: "expose-loader",
          options: {
            exposes: ["Graph"],
          },
        },
        {
          test: require.resolve("sigma"),
          loader: "expose-loader",
          options: {
            exposes: ["Sigma"],
          },
        },
        {
          test: require.resolve("uuid"),
          loader: "expose-loader",
          options: {
            exposes: ["v4"],
          },
        },
        {
          test: require.resolve("graphology-layout-force/worker"),
          loader: "expose-loader",
          options: {
            exposes: ["ForceSupervisor"],
          },
        },
      ],
    }
  };
});

/* manifest goes to lastly defined folder */
mix.js('resources/js/app.js', 'public/js');