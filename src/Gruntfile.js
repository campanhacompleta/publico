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

    makepot: {
      target: {
          options: {
              cwd: '../',                          // Directory of files to internationalize.
              domainPath: '/languages',                   // Where to save the POT file.
              mainFile: 'style.css',                     // Main project file.
              //potComments: '',                  // The copyright at the beginning of the POT file.
              potFilename: 'publico.pot',                  // Name of the POT file.
              potHeaders: {
                  poedit: true,                 // Includes common Poedit headers.
                  'x-poedit-keywordslist': true // Include a list of all possible gettext functions.
              },                                // Headers to add to the generated POT file.
              type: 'wp-theme',                // Type of project (wp-plugin or wp-theme).
              updateTimestamp: true,             // Whether the POT-Creation-Date should be updated without other changes.
              updatePoFiles: false              // Whether to update PO files in the same directory as the POT file.
          }
      }
    }
  });

  // Load npm tasks
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-wp-i18n');

  // Register tasks
  grunt.registerTask('default', ['sass', 'watch']);
  grunt.registerTask('i18n', 'makepot');
}