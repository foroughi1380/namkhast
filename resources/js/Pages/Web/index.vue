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
        <div class="card col-3 mx-auto">
          <div class="card-content row">
            <div class="card-body col-12 text-center">
              <h3 class="text-muted">تعداد کل کاربران</h3>
              <h2 class="my-2">132</h2>
            </div>
          </div>
        </div>
        <div class="card col-3 mx-auto">
          <div class="card-content row">
            <div class="card-body col-12 text-center">
              <h3 class="text-muted">تعداد کل چالش ها</h3>
              <h2 class="my-2">51</h2>
            </div>
          </div>
        </div>
        <div class="card col-3 mx-auto">
          <div class="card-content row">
            <div class="card-body col-12 text-center">
              <h3 class="text-muted">مجموع درآمد کاربران</h3>
              <h2 class="my-2">154120 تومان</h2>
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
              <p class="text-justify">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان
                گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی
                تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه
                درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای
                طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان
                امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل
                حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار
                گیرد.</p>
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
                  <div class="card">
                    <div class="card-content">
                      <img class="card-img-top img-fluid" src="/theme/web/app-assets/images/slider/01.jpg" alt="Card image cap" />
                      <div class="card-body">
                        <h4 class="card-title">نام چالش</h4>
                        <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است ...</p>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-content">
                      <img class="card-img-top img-fluid" src="/theme/web/app-assets/images/slider/01.jpg" alt="Card image cap" />
                      <div class="card-body">
                        <h4 class="card-title">نام چالش</h4>
                        <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است ...</p>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-content">
                      <img class="card-img-top img-fluid" src="/theme/web/app-assets/images/slider/01.jpg" alt="Card image cap" />
                      <div class="card-body">
                        <h4 class="card-title">نام چالش</h4>
                        <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است ...</p>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-content">
                      <img class="card-img-top img-fluid" src="/theme/web/app-assets/images/slider/01.jpg" alt="Card image cap" />
                      <div class="card-body">
                        <h4 class="card-title">نام چالش</h4>
                        <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است ...</p>
                      </div>
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
              <p class="text-justify">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان
                گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی
                تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه
                درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای
                طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان
                امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل
                حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار
                گیرد.</p>
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
  props: ['isLogin']
}
</script>

<style scoped>

</style>
