<template>
  <Head title="خانه">
    <link rel="stylesheet" type="text/css" href="/theme/web/app-assets/css-rtl/pages/faq.css">
  </Head>
  <section id="faq-search">
    <div>
      <!-- Header-->
      <div class="col-12">
        <div class="card home-bg white">
          <div class="card-content">
            <div class="card-body p-sm-4 p-2 text-center">
              <img src="/theme/web/app-assets/images/logo/logo.png" alt="users avatar"
                   class="users-avatar-shadow rounded" height="90" width="90">
              <h1 class="white font-large-2 mt-2">سامانه نام خواست</h1>
              <h4 class="card-text mb-2 text-muted">
                اولین پلتفرم اینترنتی درخواست نام در ایران
              </h4>
              <div v-if="!isLogin">
                <a href="/login" class="btn bg-gradient-primary mt-5 mr-1 mb-1 waves-effect waves-light">ورود</a>
                <a href="/register" class="btn bg-gradient-success mt-5 mr-1 mb-1 waves-effect waves-light">ثبت نام</a>
              </div>
              </div>
          </div>
        </div>
      </div>
      <!-- END: Header-->

      <!-- Info -->
      <section class="row text-center my-4" id="info">
        <div class="card col-md-3 col-sm-12 mx-auto">
          <div class="card-content row">
            <div class="card-body col-12 text-center">
              <h3 class="text-muted">تعداد کل کاربران</h3>
              <h2 class="my-2" v-text="userCount"></h2>
            </div>
          </div>
        </div>
        <div class="card col-md-3 col-sm-12 mx-auto">
          <div class="card-content row">
            <div class="card-body col-12 text-center">
              <h3 class="text-muted">تعداد کل چالش ها</h3>
              <h2 class="my-2" v-text="challengeCount"></h2>
            </div>
          </div>
        </div>
        <div class="card col-md-3 col-sm-12 mx-auto">
          <div class="card-content row">
            <div class="card-body col-12 text-center">
              <h3 class="text-muted">مجموع درآمد کاربران</h3>
              <h2 class="my-2" v-text="payments"></h2>
            </div>
          </div>
        </div>
      </section>
      <!-- End: Info-->

      <!-- About -->
      <section class="row text-center" id="about">
        <div class="card col-12 mx-auto">
          <div class="card-content row">
            <div class="card-body col-md-4 col-sm-12 text-center">
              <img src="/theme/web/app-assets/images/pages/graphic-3.png" alt="about"
                   class="users-avatar-shadow rounded" height="300" width="300">
            </div>
            <div class="card-body col-md-8 col-sm-12 text-center">
              <h2 class="mt-1 mb-3">نام خواست چیست؟</h2>
              <p class="text-justify">وبسایت نام خواست در سال ۱۴۰۰ با بهره گیری از آخرین تکنولوژی های زمینه وب در راستای ایجاد اشتغال برای افراد خلاق و کمک به افراد جویای نام برای هر جا و هر جیزی تولید و به بهره بداری رسید.
                <br>
ما در نام خواست برای دو دسته از افراد نیاز های انها را برطرف کرده ایم.
                <br>
                <br>
              ۱- افرادی که برای پروژه - فرزند - وبسایت - کسب و کار و .. خود نیازمند نام هستند.
                <br>
              ۲- افراد خلاقی که به دنبال کسب درامد هستند.
                <br>
                <br>
                هر دوی این افراد میتوانند از وبسایت ما استفاده کنند و بهترین سود دهی را برای خود و دیگران به ارمقان بیاوردند.
              </p>
            </div>
          </div>
        </div>
      </section>
      <!--End:about -->

      <!-- latestChallenge-->
      <section class="mb-3" id="decks">
          <div class="row">
            <div class="col-12 mt-3 mb-1">
              <h4 class="text-uppercase">اخرین چالش ها</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card-deck-wrapper">
                <div class="card-deck">



                  <div class="card col-lg-3 p-0" v-for="challenge in challenges">
                    <div class="card-content">
                      <img class="card-img-top img-fluid w-100" :src="challenge.picture" alt="Card image cap"  v-if="challenge.picture"/>
                      <img class="card-img-top img-fluid w-100"  src="/theme/web/app-assets/images/pages/eCommerce/1.png" alt="Card image cap" v-else/>
                      <div class="card-body">
                        <h4 class="card-title">{{challenge.title}}</h4>
                        <p class="card-text" style="max-height: 150px ; overflow: hidden" v-html="challenge.description.substring(0,200)+'...'"></p>
                      </div>
                      <Link :href="route('challenge.show' , challenge.id)" class=" btn btn-success btn-sm m-1"
                            v-if="challenge.status === 'paid'"><span
                          class="add-to-cart text-white fa fa-reply font-weight-bold">   ادامه  </span></Link>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </section>
      <!-- END: latestChallenge-->

      <!-- whyUs -->
      <section class="row text-center" id="whyUs">
        <div class="card col-12 mx-auto">
          <div class="card-content row">
            <div class="card-body col-md-8 col-sm-12 text-center">
              <h2 class="mt-1 mb-3">چرا نام خواست ؟</h2>
              <p class="text-justify">
                وبسایت نام خواست برای راحتی شما برای عضویت هزینه ای دریافت نمیکند.
                <br>
                سریع راحت حتی میتوانید برای شرکت در چالش های خود هزینه ورودی قرار دهید.
                <br>
                کارمزد کم برای ثب چالش ها
                <br>
                بدون کارمزد برای شرکت در چالش ها
                <br>
                شخصی سازی توضیحات مربوط به چالش ها
                <br>
                بدون نیاز به احراض هویت برای شرکت در چالش ها
                <br>
                بدون احراض هویت برای ثبت چالش ها
              </p>
            </div>
            <div class="card-body col-md-4 col-sm-12 text-center">
              <img src="/theme/web/app-assets/images/pages/graphic-5.png" alt="about"
                   class="users-avatar-shadow rounded" height="300" width="300">
            </div>
          </div>
        </div>
      </section>
      <!--End:whyUs -->
    </div>
  </section>
</template>

<script>
import appLayout from "../../Shared/appLayout";

export default {
  name: "index",
  layout: appLayout,
  props: ['isLogin', "userCount", "challengeCount" , "payments" , "challenges"]
}
</script>

<style scoped>

</style>
