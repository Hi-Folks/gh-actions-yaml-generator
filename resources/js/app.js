require('./bootstrap');

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Highlight code blocks and line numbers
const hljs = require('highlight.js/lib/core');
hljs.registerLanguage('yaml', require('highlight.js/lib/languages/yaml'));
window.hljs = hljs;

// Clipboard
import ClipboardJS from 'clipboard';
new ClipboardJS('.copy-btn');
