require('./bootstrap');
import {createApp, h} from 'vue'
import {createInertiaApp, Head, Link} from '@inertiajs/inertia-vue3'
import {VueReCaptcha} from 'vue-recaptcha-v3'
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';
import { ZiggyVue  } from 'ziggy';
import { Ziggy } from './ziggy';
import datePicker from "./Shared/Components/datePicker";
import CKEditor from '@ckeditor/ckeditor5-vue';

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
        vuevue.component("date-picker" , datePicker)
        vuevue.use(VueReCaptcha, {siteKey: process.env.MIX_RECAPTCHA3_SITE})
        vuevue.use(ZiggyVue , Ziggy)
        vuevue.use(CKEditor)
        vuevue.mixin({
            methods: {
                async generateRecaptchaToken(action) {
                    await this.$recaptchaLoaded()
                    return await this.$recaptcha(action);
                },
                openPayModal(price , url , description){
                    window.document.querySelector("#payModalDescription").innerHTML = description;
                    window.document.querySelector("#payModalPrice").innerHTML = price;
                    window.document.querySelector("#payModalUrl").setAttribute("href" , url);

                    let append = "?wallet=true"
                    if (url.split('?').length > 1){
                        append = "&wallet=true"
                    }
                    if (this.wallet >= price){
                        window.document.querySelector("#payModalUrlFromWallet").setAttribute('disabled' , 'disabled');
                    }else {
                        try{
                            window.document.querySelector("#payModalUrlFromWallet").removeAttribute('disabled');
                        }catch (e){}
                    }
                    window.document.querySelector("#payModalUrlFromWallet").setAttribute("href" , url + append);
                    $("#payModal").modal("show");
                },
                checkPhoneIsValid(phone){
                    let regex = /^09\d{9}$/
                    return regex.test(phone)
                },
                toast(message , type , position = "top-left"){
                    this.$toast.open({
                        message: message,
                        type: type,
                        position : position
                    });
                },
                showToasts(messages){
                    if (messages)
                    for (let t of this.toasts){
                        this.toast(t.message , t.type)
                    }
                },
                showTypedToast(messages , type , position = ""){
                    for (let message of messages){
                        this.toast(message , type , position)
                    }
                },
                cloneObject(object){
                    console.log("in clone")
                    return JSON.parse(JSON.stringify(object))
                },
                jalali: function (input , separator = "-") {
                    try {
                        let moment = require('moment-jalaali');
                        let date = moment(input, 'YYYY-MM-DD');
                        return date.format(`jYYYY${separator}jMM${separator}jDD`);
                    } catch (e) {
                        return input;
                    }
                },
                gregorian: function (input ,separator = "-") {
                    try {
                        if (input === undefined || input == null || input.length === 0) return "";
                        let moment = require('moment-jalaali');
                        let date = moment(input, `jYYYY${separator}jM${separator}jD`);
                        return date.format(`YYYY${separator}MM${separator}DD`);
                    } catch (e) {
                        return input;
                    }
                },
                translateStatus(status){
                    switch (status){
                        case 'draft' : return 'پیش نویس';
                        case 'pending' : return "در انتظار پرداخت";
                        case 'paid' : return "در حال انجام";
                        default :
                             return status;
                    }
                }
            }
        })
        vuevue.mount(el)
    },
})

