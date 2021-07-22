require('./bootstrap');
import { createApp, h } from 'vue'
import { createInertiaApp , Link } from '@inertiajs/inertia-vue3'

var vuevue;
createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        vuevue = createApp({ render: () => h(app, props)});
        vuevue.use(plugin)
        vuevue.component("Link" , Link)
        vuevue.mount(el)
    },
})

