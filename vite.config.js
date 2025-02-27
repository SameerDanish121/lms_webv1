// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// });


import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],server: {
        host: '127.0.0.1', // Your local IP
        port: 5173, // Default Vite port
        strictPort: true,
        hmr: false,
    },
    css: {
        postcss: {
          plugins: [tailwindcss()],
        },
    }
});
