module.exports = {
  // You can specify any options from https://postcss.org/api/#processoptions here
  plugins: [
    // Plugins for PostCSS
    ['autoprefixer', { grid: true }],
    ['css-declaration-sorter', { order: 'alphabetical' }],
    ['postcss-sort-media-queries', { sort: 'mobile-first' }],
  ],
};
