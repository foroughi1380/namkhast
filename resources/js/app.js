require('./bootstrap');
import { createApp, h } from 'vue'
import { createInertiaApp , Link } from '@inertiajs/inertia-vue3'
import { Head } from '@inertiajs/inertia-vue3'

var vuevue;
createInertiaApp({
    title : title => `${title} | نام خواست `,
    resolve: name => require(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        vuevue = createApp({ render: () => h(app, props)});
        vuevue.use(plugin)
        vuevue.component("Link" , Link)
        vuevue.component("Head" , Head)
        vuevue.mount(el)
    },
})

