var gulp = require('gulp');
sass = require("gulp-sass"),
postcss = require("gulp-postcss");
autoprefixer = require("autoprefixer");
var sourcemaps = require('gulp-sourcemaps'); 
var browserSync = require('browser-sync').create(); 
cssbeautify = require('gulp-cssbeautify');
var beautify = require('gulp-beautify');

/*********************************LTR****************************************/


//_______ task for scss folder to css main style 
gulp.task('watch', function() {
	console.log('Command executed successfully compiling SCSS in assets.');
	 return gulp.src('zanex/assets/scss/**/*.scss') 
		.pipe(sourcemaps.init())                       
		.pipe(sass())
		.pipe(sourcemaps.write(''))  
		.pipe(beautify.css({ indent_size: 4 })) 
		.pipe(gulp.dest('zanex/assets/css'))
		.pipe(browserSync.reload({
		  stream: true
	}))
})

//_______ task for style-dark
gulp.task('dark', function(){
   return gulp.src('zanex/assets/css/dark-style.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
		.pipe(beautify.css({ indent_size: 4 }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('zanex/assets/css/'));
		
});


//_______task for sidemenu
gulp.task('sidemenu', function(){
	return gulp.src('zanex/assets/css/sidemenu.scss')
		 .pipe(sourcemaps.init())
		 .pipe(sass())
		 .pipe(beautify.css({ indent_size: 4 }))
		 .pipe(sourcemaps.write('.'))
		 .pipe(gulp.dest('zanex/assets/css/'));
		 
 });

 
 //_______task for skin-modes
gulp.task('skins', function(){
	return gulp.src('zanex/assets/css/skin-modes.scss')
		 .pipe(sourcemaps.init())
		 .pipe(sass())
		 .pipe(beautify.css({ indent_size: 4 }))
		 .pipe(sourcemaps.write('.'))
		 .pipe(gulp.dest('zanex/assets/css/'));
		 
 });
 
//_______task for Color
gulp.task('color', function(){
	return gulp.src('zanex/assets/colors/**/*.scss')
	.pipe(sourcemaps.init())
	.pipe(sass())
	.pipe(beautify.css({ indent_size: 4 }))
	.pipe(sourcemaps.write('.'))
	.pipe(gulp.dest('zanex/assets/colors'));
});


//_______task for sidemenu-icontext
gulp.task('icontext', function(){
	return gulp.src('zanex/assets/css/sidemenu-icontext.scss')
		 .pipe(sourcemaps.init())
		 .pipe(sass())
		 .pipe(beautify.css({ indent_size: 4 }))
		 .pipe(sourcemaps.write('.'))
		 .pipe(gulp.dest('zanex/assets/css/'));
		 
});

//_______task for sidemenu-icon
gulp.task('icon', function(){
	return gulp.src('zanex/assets/css/sidemenu-icon.scss')
		 .pipe(sourcemaps.init())
		 .pipe(sass())
		 .pipe(beautify.css({ indent_size: 4 }))
		 .pipe(sourcemaps.write('.'))
		 .pipe(gulp.dest('zanex/assets/css/'));
		 
 });


/*********************************RTL****************************************/


//_______ task for scss folder to css main style 
gulp.task('watch-rtl', function() {
	console.log('Command executed successfully compiling SCSS in assets.');
	 return gulp.src('zanex/assets/scss-rtl/**/*.scss') 
		.pipe(sourcemaps.init())                       
		.pipe(sass())
		.pipe(sourcemaps.write(''))  
		.pipe(beautify.css({ indent_size: 4 })) 
		.pipe(gulp.dest('zanex/assets/css-rtl'))
		.pipe(browserSync.reload({
		  stream: true
	}))
})

//_______ task for style-dark
gulp.task('dark-rtl', function(){
   return gulp.src('zanex/assets/css-rtl/dark-style.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
		.pipe(beautify.css({ indent_size: 4 }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('zanex/assets/css-rtl/'));
		
});


//_______task for sidemenu
gulp.task('sidemenu-rtl', function(){
	return gulp.src('zanex/assets/css-rtl/sidemenu.scss')
		 .pipe(sourcemaps.init())
		 .pipe(sass())
		 .pipe(beautify.css({ indent_size: 4 }))
		 .pipe(sourcemaps.write('.'))
		 .pipe(gulp.dest('zanex/assets/css-rtl/'));
		 
 });

 
 //_______task for skin-modes
gulp.task('skins-rtl', function(){
	return gulp.src('zanex/assets/css-rtl/skin-modes.scss')
		 .pipe(sourcemaps.init())
		 .pipe(sass())
		 .pipe(beautify.css({ indent_size: 4 }))
		 .pipe(sourcemaps.write('.'))
		 .pipe(gulp.dest('zanex/assets/css-rtl/'));
		 
 });
 
//_______task for Color
gulp.task('color-rtl', function(){
	return gulp.src('zanex/assets/colors/**/*.scss')
	.pipe(sourcemaps.init())
	.pipe(sass())
	.pipe(beautify.css({ indent_size: 4 }))
	.pipe(sourcemaps.write('.'))
	.pipe(gulp.dest('zanex/assets/colors'));
});


//_______task for sidemenu-icontext
gulp.task('icontext-rtl', function(){
	return gulp.src('zanex/assets/css-rtl/sidemenu-icontext.scss')
		 .pipe(sourcemaps.init())
		 .pipe(sass())
		 .pipe(beautify.css({ indent_size: 4 }))
		 .pipe(sourcemaps.write('.'))
		 .pipe(gulp.dest('zanex/assets/css-rtl/'));
		 
});

//_______task for sidemenu-icon
gulp.task('icon-rtl', function(){
	return gulp.src('zanex/assets/css-rtl/sidemenu-icon.scss')
		 .pipe(sourcemaps.init())
		 .pipe(sass())
		 .pipe(beautify.css({ indent_size: 4 }))
		 .pipe(sourcemaps.write('.'))
		 .pipe(gulp.dest('zanex/assets/css-rtl/'));
		 
 });




