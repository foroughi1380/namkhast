<template>
  <Head>
    <title>جزئیات چالش</title>
  </Head>

  <section>
    <section class="row">
      <!-- Challenge award -->
      <div class="card col-md-3 col-sm-12 mx-auto">
        <div class="card-content row">
          <div class="card-body col-12 text-center">
            <h3><span class="fa fa-trophy"></span> {{ challenge.budget }} تومان</h3>
            <div class="text-left my-2">
              <ul>
                <li>وضعیت چالش : {{ challenge.ended_at == null ? 'باز' : 'به اتمام رسیده' }}</li>
                <li>مبلغ ورودی : {{ challenge.type == 'free' ? 'رایگان' : challenge.cost + " تومان" }}</li>
              </ul>
            </div>
            <div v-if="! challenge.mine" @click="btnClick">
              <a class="btn btn-primary btn-block text-white" v-if="! challenge.is_Contributor">عضویت در چالش</a>
              <a class="btn btn-warning btn-block text-white" v-else-if="challenge.ended_at === null">ارسال جواب</a>
            </div>
          </div>
        </div>
      </div>
      <!-- END: Challenge award -->

      <!-- Challenge hero -->
      <div class="card col-md-8 col-sm-12 mx-auto">
        <div class="card-content row">
          <div class="card-body col-12 row">
            <div class="col-3">
              <img class="img-fluid" :src="challenge.picture"
                   alt="challenge" width="100" height="150" v-if="challenge.picture">

              <img class="img-fluid" src="/theme/web/app-assets/images/portrait/small/avatar-s-18.jpg"
                   alt="challenge" width="100" height="150" v-else>

            </div>


            <div class="col-9">
              <h2>{{ challenge.title }}</h2>
              <div class="row">
                <div class="col-6">
                  <p class="item-company">دسته <span class="company-name">'{{ challenge.category }}'</span></p>
                </div>
                <div class="col-6 text-right" @click="favoriteRequest">
                  <a class="feather icon-star-on" v-if="challenge.is_favorite"> <span>حذف از علاقه مندی ها</span> </a>
                  <a class="feather icon-star" v-else> <span>اضافه کردن به علاقه مندی ها</span> </a>
                </div>
              </div>
              <p class="text-justify" v-html="challenge.description.substring(0,200)+'...'"></p>
            </div>


          </div>
        </div>
      </div>
      <!-- END: Challenge hero -->
    </section>
  </section>

  <section>
    <section class="row">
      <!-- winner user -->
      <div class="card col-md-3 col-sm-12 mx-auto height-5-per">
        <div class="card-content row">
          <div class="card-body col-12 text-center" v-if="challenge.winner_user">
            <h3>کاربر برنده</h3>
            <div class="avatar mr-50  mt-3">
              <img :src="winnerUser.picture" v-if="winnerUser.picture" alt="avtar img holder" height="100" width="100">
              <img src="/theme/web/app-assets/images/portrait/small/avatar-s-11.jpg" v-else alt="avtar img holder" height="100" width="100">
            </div>
            <h4>{{ winnerUser.name }} {{ winnerUser.family}}</h4>
          </div>
        </div>
      </div>
      <!-- END: winner user -->

      <div class="card col-md-8 col-sm-12 mx-auto">
        <div class="card-content row">
          <div class="card-body col-12">
            <section>
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active" id="descryption-tab" data-toggle="tab" href="#descryption" aria-controls="account" role="tab" aria-selected="true">
                          <i class="feather icon-info mr-25"></i><span class="d-none d-sm-block">توضیحات تکمیلی</span>
                        </a>
                      </li>
                      <li class="nav-item" v-if="challenge.mine">
                        <a class="nav-link d-flex align-items-center" id="names-tab" data-toggle="tab" href="#names" aria-controls="information" role="tab" aria-selected="false">
                          <i class="fa fa-lightbulb-o mr-25"></i><span class="d-none d-sm-block">اسامی پیشنهاد شده</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" id="participants-tab" data-toggle="tab" href="#participants" aria-controls="information" role="tab" aria-selected="false">
                          <i class="feather icon-users mr-25"></i><span class="d-none d-sm-block">شرکت کنندگان</span>
                        </a>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="descryption" aria-labelledby="descryption-tab" role="tabpanel">
                        <h4>توضیحات تکمیلی</h4>
                        <p v-html="challenge.description"></p>
<!--                        <h4 class="mt-1">توضیحات اضافی</h4>-->
<!--                        <ul>-->
<!--                          <li>حداکثر تعداد کلمه : 2</li>-->
<!--                          <li>حداکثر تعداد کاراکتر : 20</li>-->
<!--                          <li>مبلغ جایزه : 15000 تومان</li>-->
<!--                        </ul><br>-->
                        <br>
                        <div v-if="challenge.document">
                          <h4 class="mt-1">مستندات</h4>
                          <h5><a :href="challenge.document" target="_blank" download>دانلود مستندات مربوط به چالش</a></h5>
                        </div>
                      </div>

                      <div class="tab-pane" id="names" aria-labelledby="names-tab" role="tabpanel">
                        <div class="card">
                          <div class="card-header d-flex justify-content-between">
                            <h4>نام های پیشنهاد شده</h4>
                          </div>
                          <div class="card-body">
                            <div v-for="contributor in contributors" class="d-flex justify-content-start align-items-center mb-1">
<!--                              <div cl ass="avatar mr-50">-->
<!--                                <img v-for="user in users" :src="contributor.user_id == user.id ? user.picture : '' " alt="avtar img holder" height="35" width="35">-->
<!--                              </div>-->
                              <div class="user-page-info">
                                <h6 class="mb-0">نام پیشنهادی : '{{ contributor.suggested_name }}'</h6>
                                <span v-for="user in users" class="font-small-2">{{ contributor.user_id == user.id ? user.name + ' ' + user.family : ''}}</span>
                              </div>
                              <Link v-if="!challenge.ended_at" :href="route('challenge.suggest' , contributor.id)" type="button" class="btn btn-primary btn-icon ml-auto">مشاهده<i class="feather icon-external-link"> </i></Link>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" id="participants" aria-labelledby="participants-tab" role="tabpanel">
                        <div class="card">
                          <div class="card-header d-flex justify-content-between">
                            <h4>شرکت کنندگان در چالش</h4>
                          </div>
                          <div class="card-body">
                            <div v-for="contributor in contributors" class="d-flex justify-content-start align-items-center mb-1">
<!--                              <div class="avatar mr-50">-->
<!--                                <img v-for="user in users" :src="contributor.user_id == user.id ? user.picture : '/theme/web/app-assets/images/portrait/small/avatar-s-11.jpg' " alt="avtar img holder" height="35" width="35">-->
<!--                              </div>-->
                              <div class="user-page-info">
                                <h6 v-for="user in users" class="mb-0">{{ contributor.user_id == user.id ? user.name + ' ' + user.family : ''}}</h6>
                              </div>
<!--                              <button type="button" class="btn btn-primary btn-icon ml-auto">پروفایل کاربر<i class="feather icon-external-link"> </i></button>-->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
import appLayout from "../../Shared/appLayout";
import {Inertia} from "@inertiajs/inertia";

export default {
  name: "challengeDetail",
  layout: appLayout,
  props: {
    challenge : {},
    winnerUser : {},
    contributors : {},
    users : {},
    errors : []
  },
  methods : {
    favoriteRequest(){
      axios.put(this.route("favorite.update" , this.challenge.id))
          .then(value => {
            this.toast("با موفقیت اضافه شد")
          }).catch(reason => {this.toast("عملیات با شکست مواجه شد" , "error")})
          .finally(() => {
            this.challenge.is_favorite = ! this.challenge.is_favorite;
          })
    },
    btnClick(){
      Inertia.get(this.route('contributor' , this.challenge.id) , {} , {
        onFinish :params => {
          this.showTypedToast(this.errors , "error")
        }
      })
    }
  }
}
</script>

<style scoped>

</style>