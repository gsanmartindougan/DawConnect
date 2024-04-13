import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/sass/app.scss',
            'resources/js/app.js',
            'resources/css/app.css',
            'resources/js/summernote-lite.js',
            'resources/css/summernote-lite.css',
        ]),
        {
            name: 'blade',
            handleHotUpdate({file, server}){
                if(file.endsWith('.blade.php')){
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    })
                }
            }
        }
    ],
    build: {
        sourcemap: true
    }
});
