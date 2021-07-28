require('./bootstrap');
import {createApp, h} from 'vue'
import {createInertiaApp, Head, Link} from '@inertiajs/inertia-vue3'
import {VueReCaptcha} from 'vue-recaptcha-v3'
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';
import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';



createInertiaApp({
    title: title => `${title} | نام خواست `,
    resolve: name => require(`./Pages/${name}`),
    setup({el, app, props, plugin}) {
        let vuevue = createApp({render: () => h(app, props)});
        vuevue.use(plugin)
        vuevue.use(VueToast , {
            position : "top-left"
        })
        vuevue.component("Link", Link)
        vuevue.component("Head", Head)
        vuevue.use(VueReCaptcha, {siteKey: process.env.MIX_RECAPTCHA3_SITE})
        vuevue.mixin({
            methods: {
                async generateRecaptchaToken(action) {
                    await this.$recaptchaLoaded()
                    return await this.$recaptcha(action);
                },
                checkPhoneIsValid(phone){
                    let regex = /^09\d{9}$/
                    return regex.test(phone)
                },
                toast(message , type){
                    this.$toast.open({
                        message: message,
                        type: type,

                    });
                },
                showToasts(messages){
                    if (messages)
                    for (let t of this.toasts){
                        this.toast(t.message , t.type)
                    }
                }
            }
        })
        vuevue.mount(el)

    },
})

