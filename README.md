# Meli - Test

### Resumen

Desafío Mercado Libre

### Enlaces relevantes

Live: http://cristiantorrico.com/challenge/meli/

### Puesta en marcha

Requerimientos Generales

- PHP >= 7.1.0
- NPM >= 6.4.1
- HTML + CSS
- jQuery
- Gulp + Autoprefixer + Concat + Uglify (dev only)
- SASS (dev only)

### Pre-requisitos

- node
- npm
- gulp

## Desarrollo

```shell

# Browse to project folder
cd /path/to/project/this/folder

# Install browserSync and other dependencies
npm install

# Start server
gulp watch

# Start server and also minify the created CSS files
gulp min or npm run min (if no global gulp)

#if you don't want to or have gulp installed globally run
npm start
```

### Additional commands

To minify existing CSS files run `gulp minify-css` or `npm run minify-css` if you don't have gulp globally installed.

### Quick Links

- [gulp](http://gulpjs.com)
- [BrowserSync](http://www.browsersync.io)
- [node-js](https://nodejs.org/en/)
