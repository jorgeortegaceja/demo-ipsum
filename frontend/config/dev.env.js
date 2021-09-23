'use strict'
const merge = require('webpack-merge');
const prodEnv = require('./prod.env');

module.exports = merge(
    prodEnv, {
        apiUrl: '"https://demo-ipsum.herokuapp.com/api"'
    }
)
