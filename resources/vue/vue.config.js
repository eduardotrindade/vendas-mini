module.exports = {
  productionSourceMap: false,
  configureWebpack: {
    devtool: false,
    optimization: {
      splitChunks: {
        chunks: 'all'
      }
    },
  },
  css: {
    extract: true
  },
  publicPath: process.env.VUE_APP_PUBLIC_PATH,
  outputDir: process.env.VUE_APP_OUTPUT_DIR,
  assetsDir: process.env.VUE_APP_ASSETS_DIR,
  devServer: {
    disableHostCheck: true,
    port: 8000,
    public: '0.0.0.0'
  },
}
