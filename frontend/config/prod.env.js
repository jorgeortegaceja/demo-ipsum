'use strict'
const merge = require('webpack-merge');
const prodEnv = require('./prod.env');

module.exports = merge(
    prodEnv, {
        apiUrl: '"http://localhost:8001/api"'

    }
)
