import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createPinia } from 'pinia';
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import 'vue-blurhash/dist/vue-blurhash.css'
/* import VueBlurHash from 'vue-blurhash'
import 'vue-blurhash/dist/vue-blurhash.css' */
const pinia = createPinia()
const appName = 'Koljan';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)

            .use(ToastPlugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        progress: {
            color: '#4B5563',
        },
    },
});

