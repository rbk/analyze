module.exports = function(grunt) {
  grunt.initConfig({
      pkg: grunt.file.readJSON('package.json'),
      concurrent: {
        target: {
            tasks: ['nodemon', 'watch'],
            options: {
                logConcurrentOutput: true
            }
        }
      },
      sass: {
          dist: {
              options: {
                style: 'compressed'
              },
              files: {
                  'css/app.css' : 'scss/app.scss'
              }
          }
      },
      uglify: {
          options: {
           mangle: false,
            compress: {
              drop_console: true
            }
          },
          dist: {
              options: {
                  beautify: false
              },
              files: {
                  'js/build/production.min.js': ['js/app.js'],
                  'js/build/client.min.js' : ['node_modules/socket.io-client/socket.io.js']
              }
          }
      },
      nodemon: {
        dev: {
          script: 'server.js'
        }
      },
      watch: {
          css: {
              files: '**/*.scss',
              tasks: ['sass']
          },
          js: {
              files: ['js/*.js', 'node_modules/socket.io-client/socket.io.js'],
              tasks: ['uglify']
          },
          server: {
            files: ['server.js'],
            tasks: ['nodemon']
          }
      }
  });
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-nodemon');
  grunt.loadNpmTasks('grunt-concurrent');
  grunt.registerTask('default', [ 'concurrent:target' ]);
}