const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries');

/**
 * 設定
 */
const dir = {
  src: 'src',
  dist: './',
  assets: 'assets'
}
const baseDir = './'

const settings = {
  sass: [
    true,
    { compressed: false }
  ]
}

/**
 * エントリーポイントの指定
 */
const entryPoints = {
  main: [ `./${dir.src}/styles/common.scss` ]
}

/**
 * browserSync
 */
const browserOptions = {
  host: 'localhost',
  port: 3000,
  open: 'external',
  server: { baseDir: baseDir }
}

/**
 * exports
 */
module.exports = (env, argv) => {
  const isDev = process.env.NODE_ENV !== "production"

  return {
    // entry: `./${dir.src}/styles/common.scss`,
    entry: {
      ...entryPoints
    },
    output: {
      path: path.resolve(__dirname, dir.dist),
    },
    mode: argv.mode,
    cache: true,
    module: {
      rules: [
        {
          test: /\.(css|s[ac]ss)$/,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: 'css-loader',
              options: {
                url: false,
                sourceMap: isDev
              }
            },
            {
              loader: 'postcss-loader',
              options: {
                sourceMap: isDev
              }
            },
            {
              loader: 'sass-loader',
              options: {
                implementation: require('sass'),
                sassOptions: {
                  outputStyle: settings.sass[1].compressed ? 'compressed' : 'expanded',
                },
                sourceMap: isDev
              }
            }
          ]
        },
      ]
    },

    plugins: [
      new BrowserSyncPlugin(browserOptions),
      new MiniCssExtractPlugin({
        filename: `./${dir.assets}/styles/common.css`
      }),
      new FixStyleOnlyEntriesPlugin()
    ]
  }
}
