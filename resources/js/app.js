require('./bootstrap');

import 'alpinejs';

// Highlight code blocks and line numbers
const hljs = require('highlight.js');
window.hljs = hljs;
require('highlightjs-line-numbers.js');
hljs.initHighlightingOnLoad();

// Clipboard
import ClipboardJS from 'clipboard';
new ClipboardJS('.copy-btn');
