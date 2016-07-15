import path from 'path';
import webpack from 'webpack';
import CopyWebpackPlugin from 'copy-webpack-plugin';

export default {
	context: path.resolve('./'),
	entry: {
		omLightbox: "./js/app"
	},

	// Výstupní soubory...
	output: {
		pathinfo: true,
		filename: "./dist/[name].min.js",
		chunkFilename: "./dist/[id].js",
		sourceMapFilename: "./dist/[name].min.js.map"
	},

	externals: {'jquery': 'jQuery'},

	resolve: {
		modulesDirectories: ['node_modules', 'public/js'],
		extensions: ['', '.js', '.jsx']
	},

	module: {
		loaders: [
			{test: /\.jsx?$/, loader: 'babel', include: /js/}
		]
	},

	plugins: [
		new CopyWebpackPlugin([{from: 'node_modules/magnific-popup/dist/magnific-popup.css', to: 'dist/omLightbox.css'}]),
		new webpack.optimize.UglifyJsPlugin(
				{
					comments: false,
					sourceMap: false,
					pathinfo: false,
					compress: {screw_ie8: true, keep_fnames: true, warnings: false},
					mangle: {screw_ie8: true, keep_fnames: true, except: ['$', 'jQuery']}
				}
		)
	]
};