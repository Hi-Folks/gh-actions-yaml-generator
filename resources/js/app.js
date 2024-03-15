import './bootstrap';

//import Alpine from 'alpinejs';
//window.Alpine = Alpine;
//Alpine.start();

// Highlight code blocks and line numbers
import hljs from 'highlight.js/lib/core';
import yamlH from 'highlight.js/lib/languages/yaml'
hljs.registerLanguage('yaml', yamlH);
window.hljs = hljs;

// Clipboard
import ClipboardJS from 'clipboard';
new ClipboardJS('.copy-btn');
