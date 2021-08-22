<template>
  <section class="grid-view row justify-content-center overflow-hidden">
    <div class="card ecommerce-card">
      <div class="card-content row w-100">


        <div class="col-lg-3 col-md-12 col-sm-12 text-center px-0 swiper-slide-shadow-left">
            <img :src="challenge.picture" alt="img-placeholder" v-if="challenge.picture" width="266" height="206">
            <img src="/theme/web/app-assets/images/pages/eCommerce/1.png" alt="img-placeholder"  width="266" height="206"
                 v-else >
        </div>


        <div class="col-lg-6 col-md-6 col-sm-12 card-body my-1">
          <div class="item-name">
            <h3 href="app-ecommerce-details.html" v-text="challenge.title"></h3>

          </div>
          <hr/>
          <div>
            <p style="height: 0 ; overflow: hidden">
              fffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasd</p>
            <p class="item-description text-justify max-limit description" v-html="challenge.description.substring(0,200)+'...'"></p>
          </div>


          <div class="mt-auto ">
            <Link class="text-white btn btn-success btn-sm m-1 fa fa-edit font-weight-bold" :href="route('challenge.edit' , challenge.id)"
                  v-if="challenge.mine && challenge.status === 'draft' " v-text="' ویرایش '"></Link>

            <a class=" btn btn-warning btn-sm m-1" @click="openPayModal(challenge.payPrice , route('challenge.pay' , challenge.id) , 'جهت ثبت چالش')"
               v-if="challenge.mine && (challenge.status === 'draft' || challenge.status === 'pending')">
              <span class="text-white fa font-weight-bold fa-paypal"> پرداخت نهایی </span>
            </a>

            <Link :href="route('challenge.show' , challenge.id)" class=" btn btn-success btn-sm m-1"
                  v-if="challenge.status === 'paid'"><span
                class="add-to-cart text-white fa fa-reply font-weight-bold">   ادامه  </span></Link>
          </div>

          <hr class="col-lg-1  col-md-1 col-sm-12"/>

        </div>


        <div class="col-lg-3 col-md-3 col-sm-12 text-center h-100 d-flex flex-column align-items-stretch px-0 align-self-start">
          <section>


            <div class="text-right mt-1 " @click="favoriteRequest">
              <span class="feather icon-star-on" v-if="challenge.is_favorite"></span>
              <span class="feather icon-star" v-else></span>
            </div>




            <p class="font-size-large fa fa-trophy"></p>
            <h4 class="item-price" >
              <span v-text="challenge.budget"></span>
              تومان
            </h4>


            <hr/>

            <p>
              <span> دسته : </span>
              <span class="company-name text-nowrap" v-text="challenge.category"></span>
            </p>
            <p class="item-company">
              <span> وضعیت : </span>
              <span class="company-name text-nowrap" v-if="challenge.ended_at != null">پایان یافته</span>
              <span class="company-name text-nowrap" v-text="translateStatus(challenge.status)" v-else> </span>
            </p>
            <p class="item-company">
              <span>شیوه ورودی: </span>
              <span class="company-name" v-text="challenge.type === 'free' ? 'رایگان' : 'پولی'">

              </span>
            </p>

          </section>
        </div>
      </div>
    </div>
  </section>

</template>

<script>
export default {
  name: "ChallengeRow",
  props: ['challenge'],
  methods: {
    favoriteRequest() {
      axios.put(this.route("favorite.update", this.challenge.id))
          .then(value => {
            this.toast("با موفقیت انجام شد")
          }).catch(reason => {
        this.toast("عملیات با شکست مواجه شد", "error")
      })
          .finally(() => {
            this.challenge.is_favorite = !this.challenge.is_favorite;
          })
    }
  }
}
</script>

<style scoped>
.description {
  max-height: 100px;
  overflow: hidden;
  overflow-style: marquee-line;
}
</style>