const MiniCssExtractPlugin = require("mini-css-extract-plugin"),
    Path = require('path');
const CopyPlugin = require("copy-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");

const PROD = JSON.parse(process.env.PROD_ENV || '0');
const PUBLIC_FOLDER = Path.resolve(__dirname + '/public');
module.exports = {
    optimization: {
        minimize: true,
        minimizer: [
            new CssMinimizerPlugin(),
            new TerserPlugin({
                extractComments: false
            })
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'css/[name].css'
        }),
        new CopyPlugin({
            patterns: [
                /*{
                    from: Path.resolve('src/assets/img'),
                    to: Path.resolve(PUBLIC_FOLDER + '/img'),
                },*/
                {
                    from: Path.resolve('src/php/' + (PROD ? "index.prod.php" : "index.dev.php")),
                    to: Path.resolve(PUBLIC_FOLDER + '/index.php')
                }
            ]
        })
    ],
    mode: PROD ? 'production' : 'development',
    devtool: PROD ? undefined : 'inline-source-map',
    module: {
        rules: [
            {
                test: /\.ts$/,
                use: "ts-loader",
                exclude: /node_modules/,
            },
            {
                test: /\.css$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader'
                ],
            },
            {
                test: /\.scss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'resolve-url-loader',
                    "sass-loader"
                ]
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf|gif)$/i,
                type: 'asset/resource',
            }
        ],
    },
    resolve: {
        extensions: [".ts", ".js"],
    },
    entry: {
        page: './src/js/page.entry.ts',
    },
    output: {
        path: PUBLIC_FOLDER,
        filename: 'js/[name].js'
    }
};