var path = require('path')
var webpack = require('webpack')

module.exports = {
  plugins: [
  ],
  entry: './data/assets/mobile-c/js/bundle.js',
  output: {
    path: path.resolve(__dirname, './data/assets/mobile-c/js/'),
    publicPath: '/temp/',
    filename: 'bundle.js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        options: {
          "presets": [
            ["es2015", {
              "modules": false
            }]
          ]
        },
        exclude: /node_modules/
      }

    ]
  },
  devServer: {
    historyApiFallback: true,
    noInfo: true,
    port: 9000
  },
  performance: {
    hints: false
  },
  devtool: '#eval-source-map',
}

process.env.NODE_ENV = 'production';

if (process.env.NODE_ENV === 'production') {
  module.exports.devtool = '#source-map'
  // http://vue-loader.vuejs.org/en/workflow/production.html
  module.exports.plugins = (module.exports.plugins || []).concat([
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"production"'
      }
    }),
    new webpack.optimize.UglifyJsPlugin({
      sourceMap: true,
      compress: {
        warnings: false
      }
    }),
    new webpack.LoaderOptionsPlugin({
      minimize: true
    })
  ])
}