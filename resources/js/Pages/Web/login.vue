<template>
  <Head title="ورود"></Head>
  <div class="card bg-authentication rounded-0 mb-0">
    <div class="row m-0">
      <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
        <img src="/theme/web/app-assets/images/pages/login.png" alt="branding logo">
      </div>
      <div class="col-lg-6 col-12 p-0">
        <div class="card rounded-0 mb-0 px-2">
          <div class="card-header pb-1">
            <div class="card-title">
              <h4 class="mb-0" v-if="! inGetConfirm">ورود</h4>
              <h4 class="mb-0" v-else>تایید تلفن</h4>
            </div>
          </div>
          <p class="px-2" v-if="! inGetConfirm">لطفا شماره تماس خود را در کادر زیر وارد کنید</p>
          <p class="px-2" v-else>کد تایید ارسال شده به تلفن همراه خود را وارد کنید</p>
          <div class="card-content">
            <div class="card-body pt-1">

              <section class="text-center">

                <IconInputText type="number" name="phone" icon="icon-phone" placeholder="شماره تلفن" label="شماره تلفن" :disabled="inProcess" v-model="phone" v-if="! inGetConfirm"></IconInputText>
                <IconInputText type="number" name="phone" icon="icon-code" placeholder="کد تایید ۴ رقمی ارسالی به شما" label="کد تایید" :disabled="inProcess" v-model="code" v-else></IconInputText>
                <p class="text-danger " v-for="err in errors" v-text="err"></p>
                <button @click="submit" class="btn btn-primary  btn-inline">
                  <span  v-if="! inProcess" v-text="inGetConfirm?'تایید':'ورود'"></span>
                  <hollow-dots-spinner v-else
                      :animation-duration="1000"
                      :dot-size="10"
                      :dots-num="3"
                      color="#ffffff"
                  />
                </button>
              </section>
            </div>
          </div>
          <div class="login-footer">
            <div class="divider">
              <div class="divider-text">اگر حساب ندارید</div>
            </div>
            <div class="footer-btn d-flex align-items-center justify-content-center pb-1">
              <Link href="/" class="card-link mr-2 ml-2">بازگشت به صفحه اصلی</Link>
              ویا
              <Link href="/register" class="card-link mr-2 ml-2">ثبت نام</Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import IconInputText from "../../Shared/Components/IconInputText";
import { HollowDotsSpinner } from 'epic-spinners'
import { Inertia } from '@inertiajs/inertia'


export default {
  name: "login",
  props:{
    errors : {},
    conf : false,
    refresh : false
  },
  data(){
    return {
      inProcess : false,
      phone : "",
      code : "",
      inGetConfirm : false ,
    }
  },
  components : {IconInputText , HollowDotsSpinner},
  methods : {
    submit(){
      if (this.inGetConfirm){
        this.confirm();
      }else{
        this.sendCode();
      }
    },
    confirm(){
      this.inProcess = true;

      this.generateRecaptchaToken('login').then(token => {
        Inertia.post('/login' , {
          phone:this.phone,
          code:this.code,
          token :token
        } , {
          onSuccess : page=>{
            if (this.refresh){
              window.location.reload();
            }
            this.inGetConfirm = this.conf;
          },
          onFinish : visit =>{
            this.inProcess = false;
          },
        })
      }).catch(err=>{
        this.errors = {
          captcha : "خطا در حل کپچا در صورت برترف نشدن مشکل با بارگذاری مجدد صفحه با پشتیبانی تماس بگیرید."
        }
      })
    },
    sendCode(){
      this.inProcess = true;

      this.generateRecaptchaToken('login').then(token => {
        Inertia.post('/login' , {
          phone:this.phone,
          token :token
        } , {
          onSuccess : page=>{
            this.inGetConfirm = this.conf;
          },
          onFinish : visit =>{
            this.inProcess = false;
          },
        })
      }).catch(err=>{
        this.errors = {
          captcha : "خطا در حل کپچا در صورت برترف نشدن مشکل با بارگذاری مجدد صفحه با پشتیبانی تماس بگیرید."
        }
      })

    }
  }
}
</script>

<style scoped>

</style>