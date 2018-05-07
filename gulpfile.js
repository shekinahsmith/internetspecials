var gulpMain = require('gulp');
var pkg = require('./package.json');
var rvlp = require('rv-landingpage-gulp');

gulp = rvlp(gulpMain, pkg);