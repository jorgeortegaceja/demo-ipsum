module.exports = {
    transpileDependencies: [
        'vuetify'
    ],
    configureWebpack: {
        resolve: {
            extensions: ['.js', '.vue', '.json'],
            alias: {
                'vue$': 'vue/dist/vue.esm.js',
                '@': './src',
            }
        },
    }
}
