
try {
    window.jQuery = window.$ = require('jquery');
    require('./custom');
    require('./slider');
    require('slick-carousel');
    require('lazysizes');
    require('jquery-ui');
}
catch (e) {
    console.log(' JS error =)')
}
