var fs = require('fs')

module.exports = function(grunt) {

  grunt.initConfig({

    sass: {

      dev: {
        options: {
          style: 'nested'
        },
        expand: true,
        cwd: 'src/scss/',
        src: ['*.scss', '!_*'],
        dest: 'deploy/public/css/',
        ext: '.css'
      }
    },

    watch: {
      sass: {
        files: ['src/scss/**/*.scss'],
        tasks: ['sass:dev']
      },
      js: {
        files: ['src/js/*.js'],
        tasks: ['concat', 'uglify']
      }
    },

    concat: {
      options: {
        separator: ';'
      },
      dist: {
        src: [
          'src/js/bsides.js',
        ],
        dest: 'deploy/public/js/bsides.js'
      }
    },

    uglify: {
        js: {
            files: { 'deploy/public/js/bsides.min.js': 'deploy/public/js/lad.js' },
            options: {
                preserveComments: false
            }
        }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-sass')
  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.registerTask('default', ['watch'])

}

