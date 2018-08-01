import path from 'path'
import MiniCssExtractPlugin from 'mini-css-extract-plugin'

module.exports = {

	entry: {
		omLightbox: './src/index.js'
	},

	output: {
		path: path.resolve(__dirname, 'dist'),
		filename: '[name].min.js'
	},

	module: {
		rules: [
			{
				test: /\.css$/,
				use: [MiniCssExtractPlugin.loader, 'css-loader']
			}
		]
	},

	plugins: [
		new MiniCssExtractPlugin({
			filename: "[name].css",
			chunkFilename: "[id].css"
		})
	],

	externals: {
		"jquery": "jQuery"
	},
};
