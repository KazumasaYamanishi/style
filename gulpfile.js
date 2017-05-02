// Gulp.js configuration
var gulp = require('gulp'),
	postcss = require('gulp-postcss');

// apply PostCSS plugins
gulp.task('css', function() {
	return gulp.src('./src/base.css')
		.pipe(postcss([
			require('postcss-import'),
			require('postcss-nested'), //ネスト
			require('postcss-custom-properties'), //変数
			require('postcss-custom-selectors'), //変数
			require('postcss-custom-media'), //メディアクエリ
			require('postcss-color-function'), //色の関数
			require('postcss-calc'), //calc関数
			require('postcss-selector-not'), //「:not」
			require('postcss-flexbugs-fixes'), //flexプロパティのバグ
			require('postcss-selector-matches'), //「:matches」
			require('postcss-apply'), //Mixin
			require('css-mqpacker'), //メディアクエリをひとまとめに
			require('autoprefixer')({ browsers: ['last 2 versions'] }), //ベンダープレフィックス
			require('cssnano') //minifyする
		]))
		.pipe(gulp.dest('./addas/css/'));
});
