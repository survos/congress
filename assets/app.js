// make sure $ and jquery are global
const $ = require('jquery');
global.jQuery = global.$ = $;
require('popper.js');

require('admin-lte'); // This comes from yarn add admin-lte (not the admin-lte bundle, which includes bootstrap).
require('bootstrap');

require('./styles/app.scss');

// The Save and Update buttons from the crud generator should pop a bit.
$('button:contains(Save)').addClass('btn-primary');
$('button:contains(Update)').addClass('btn-primary');

// alas, this is a bit heavy, we should just get what we need.
// @todo: add fontawesome pro

// start the Stimulus application. This is NOT the Bootstrap library at getbootstrap.com
import './bootstrap';

// the sidebar needs this to open nested menus.
// eslint-disable-next-line new-cap
$('.js-toggle-sidebar').PushMenu({});
