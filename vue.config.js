module.exports = {
  productionSourceMap: true,
  configureWebpack: {
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
}
