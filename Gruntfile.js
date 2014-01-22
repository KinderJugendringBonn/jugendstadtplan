// Generated on 2013-11-23 using generator-angular 0.6.0-rc.2
'use strict';

// # Globbing
// for performance reasons we're only matching one level down:
// 'test/spec/{,*/}*.js'
// use this if you want to recursively match all subfolders:
// 'test/spec/**/*.js'

module.exports = function (grunt) {

  // Load grunt tasks automatically
  require('load-grunt-tasks')(grunt);

  // Time how long tasks take. Can help when optimizing build times
  require('time-grunt')(grunt);

  // Define the configuration for all the tasks
  grunt.initConfig({

    // Project settings
    yeoman: {
      // configurable paths
      app: require('./bower.json').appPath || 'app',
      dist_css: 'web/css',
      dist_js: 'web/js',
      dist_img: 'web/img',
      bundleSource: 'src/Kjrb/Bundle/JugendstadtplanBundle/Resources/views/Public'
    },

    // Watches files for changes and runs tasks based on the changed files
    watch: {
      sass: {
          files: ['<%= yeoman.bundleSource %>/scss/**/*.{scss,sass}'],
          tasks: ['sass:dist', 'autoprefixer']
      },
      svgmin: {
          files: ['<%= yeoman.bundleSource %>/img/*.{svg}'],
          tasks: ['svgmin:dist']
      },
      imgmin: {
          files: ['<%= yeoman.bundleSource %>/img/*.{png,jpg,jpeg,gif}'],
          tasks: ['imgmin:dist']
      },
      livereload: {
        options: {
            livereload: true
        },
        files: [
          '<%= yeoman.dist_css %>/*.css',
          '<%= yeoman.dist_img %>/*.{png,jpg,jpeg,gif,webp,svg}'
        ]
      },
      gruntfile: {
            files: ['Gruntfile.js']
      }
    },

    // Empties folders to start fresh
    clean: {
      dist: {
        files: [{
          dot: true,
          src: [
            '.tmp',
            '<%= yeoman.dist_js %>/*',
            '<%= yeoman.dist_img %>/*',
            '<%= yeoman.dist_css %>/*',
            '!<%= yeoman.dist %>/.git*',
            '!<%= yeoman.dist %>/.hg*'
          ]
        }]
      },
      server: '.tmp'
    },

    // Add vendor prefixed styles
    autoprefixer: {
      options: {
        browsers: ['last 1 version']
      },
      dist: {
        files: [{
          expand: true,
          cwd: '.tmp/styles/',
          src: '{,*/}*.css',
          dest: '.tmp/styles/'
        }]
      }
    },

    // Renames files for browser caching purposes
    rev: {
      dist: {
        files: {
          src: [
            '<%= yeoman.dist_js %>/{,*/}*.js',
            '<%= yeoman.dist_img %>/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
          ]
        }
      }
    },

    // The following *-min tasks produce minified files in the dist folder
    imagemin: {
      dist: {
        files: [{
          expand: true,
          cwd: '<%= yeoman.bundleSource %>/img',
          src: '{,*/}*.{png,jpg,jpeg,gif}',
          dest: '<%= yeoman.dist_img %>'
        }]
      }
    },
    svgmin: {
      dist: {
        files: [{
          expand: true,
          cwd: '<%= yeoman.bundleSource %>/img',
          src: '{,*/}*.svg',
          dest: '<%= yeoman.dist_img %>'
        }]
      }
    },

    // Allow the use of non-minsafe AngularJS files. Automatically makes it
    // minsafe compatible so Uglify does not destroy the ng references
//    ngmin: {
//      dist: {
//        files: [{
//          expand: true,
//          cwd: '.tmp/concat/scripts',
//          src: '*.js',
//          dest: '.tmp/concat/scripts'
//        }]
//      }
//    },

    sass: {
        dist: {
            files: {
                '<%= yeoman.dist_css %>/screen.css': '<%= yeoman.bundleSource %>/scss/screen.scss'
            }
        }
    },

    // Run some tasks in parallel to speed up the build process
    concurrent: {
      dist: [
        'sass:dist',
        'imagemin',
        'svgmin'
      ]
    }

  });

  grunt.registerTask('build', [
    'clean:dist',
    'concurrent:dist',
    'autoprefixer',
//    'ngmin',
    'sass:dist',
//    'rev'
  ]);

  grunt.registerTask('default', [
    'build'
  ]);
};
