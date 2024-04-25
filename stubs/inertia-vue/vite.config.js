import { defineConfig, splitVendorChunkPlugin} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import copy from 'rollup-plugin-copy'
import path from 'path';
import webpack from 'webpack';

export default defineConfig({
    chainWebpack: config => {
        config.module
            .rule('images')
            .set('parser', {
                dataUrlCondition: {
                    maxSize: 50 * 1024 // 4KiB
                }
            })
    },
    plugins: [
        copy({
            targets: [
                { src: 'resources/images/**/*', dest: 'public/images' },
                { src: 'resources/libs/**/*', dest: 'public/libs' }
            ]
        }),
        laravel({
            input: [
                'resources/js/app.js',
                'resources/scss/app.scss'
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
