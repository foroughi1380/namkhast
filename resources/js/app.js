require('./bootstrap');
import {createApp, h} from 'vue'
import {createInertiaApp, Head, Link} from '@inertiajs/inertia-vue3'
import {VueReCaptcha} from 'vue-recaptcha-v3'

var vuevue;
createInertiaApp({
    title: title => `${title} | نام خواست `,
    resolve: name => require(`./Pages/${name}`),
    setup({el, app, props, plugin}) {
        vuevue = createApp({render: () => h(app, props)});
        vuevue.use(plugin)
        vuevue.component("Link", Link)
        vuevue.component("Head", Head)
        vuevue.use(VueReCaptcha, {siteKey: process.env.MIX_RECAPTCHA3_SITE})
        vuevue.mixin({
            methods: {
                async generateRecaptchaToken(action) {
                    await this.$recaptchaLoaded()
                    return await this.$recaptcha(action);
                }
            }
        })
        vuevue.mount(el)
    },
})

