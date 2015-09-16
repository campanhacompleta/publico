'use strict';

module.exports = function(grunt) {
  grunt.initConfig({
    
    // Get the package vars
    pkg: grunt.file.readJSON( 'package.json' ),

    // Set folder templates
    dirs: {
      css: '../assets/css',
      js: '../assets/js',
      sass: '../assets/sass'
    },

    // Copy files
    /*
    copy: {
      foundation_scss: {
        files: [{
          expand: true,
          flatten: true,
          cwd: 'bower_components/',
          src: 'foundation/css/*.min.css',
          dest: '../assets/css/'
        }]      
      },
      foundation_js: {
        files: [{
          expand: true,
          flatten: true,
          cwd: 'bower_components/',
          src: 'foundation/js/foundation.min.js',
          dest: '../assets/js/'
        }]
      },
      fullpage_css: {
        files: [{
          expand: true,
          flatten: true,
          cwd: 'bower_components/',
          src: 'fullpage.js/jquery.fullPage.css',
          dest: '../assets/css/'
        }]
      },
      fullpage_js: {
        files: [{
          expand: true,
          flatten: true,
          cwd: 'bower_components/',
          src: 'fullpage.js/jquery.fullPage.min.js',
          dest: '../assets/js/'
        }]
      }
    },
    */

    // Compile SASS files
    sass: {
      dist: {
        options: {
          style: 'compressed'
        },
        files: [{
            expand: true,
            cwd: '../assets/sass',
            src: ['**/*.scss'],
            dest: '../assets/css',
            ext: '.css'
        }]
      }
    },

    // Watch for changes and trigger sass. TODO: jshint, uglify and livereload browser
    watch: {
      sass: {
        files: [
          '<%= dirs.sass %>/**'
        ],
        tasks: ['sass']
      },
      livereload: {
        options: {
          livereload: true
        },
        files: [
          '<%= dirs.css %>/*.css',
        ]
      },
      options: {
        spawn: false
      }
    },
  });
    
  // Load npm tasks
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Register tasks
  grunt.registerTask('default', ['sass', 'watch']);
}