<template>
  <section class="grid-view row justify-content-center">
    <div class="card ecommerce-card">
      <div class="card-content row w-100">
        <div class="col-3">
          <a>
            <img  :src="challenge.picture" alt="img-placeholder" v-if="challenge.picture" width="266" height="206">
            <img  src="/theme/web/app-assets/images/pages/eCommerce/1.png" alt="img-placeholder" height="206" width="266"  v-else>
          </a>
        </div>
        <div class="card-body col-6">
          <div class="item-name">
            <h3 href="app-ecommerce-details.html" v-text="challenge.title"></h3>
            <div class="row">
              <p class="item-company col-4">دسته <span class="company-name" v-text="challenge.category"></span></p>
              <p class="item-company col-4">وضعیت : <span class="company-name" v-text="challenge.status"></span></p>
              <p class="item-company col-4 text-right">ورودی <span class="company-name" v-text="challenge.type === 'free' ? 'رایگان' : 'پولی'"></span></p>
            </div>
          </div>
          <div>
            <p style="height: 0 ; overflow: hidden">fffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasdfasdfasdfasdffffasd</p>
            <p class="item-description text-justify" v-text="challenge.description"></p>
          </div>
        </div>
        <div class="col-3 text-center my-auto">
          <div class="item-cost">
            <h4 class="item-price mb-4">
              <span v-text="challenge.budget"></span>
               تومان
            </h4>
          </div>
          <div class="cart mr-1 mt-1" v-if="challenge.mine && challenge.status === 'draft' ">
            <Link class=" btn btn-success btn-block" :href="route('challenge.edit' , challenge.id)"> <span class="add-to-cart text-white">ویرایش</span> </Link>
          </div>

          <div class="cart mr-1 mt-1" v-if="challenge.mine && (challenge.status === 'draft' || challenge.status === 'pending')">
            <a class=" btn btn-warning btn-block" :href="route('challenge.pay' , challenge.id)"> <span class="add-to-cart text-white">پرداخت نهایی</span> </a>
          </div>

          <div class="cart mr-1 mt-1" v-if="challenge.status === 'paid'">
            <Link :href="route('challenge.show' , challenge.id)" class=" btn btn-info btn-block"> <span class="add-to-cart text-white">مشاهده جزئیات</span> </Link>
          </div>

          <div class="wishlist col-12" @click="favoriteRequest">
            <a class="feather icon-star-on" v-if="challenge.is_favorite"> <span>حذف از علاقه مندی ها</span> </a>
            <a class="feather icon-star" v-else> <span>اضافه کردن به علاقه مندی ها</span> </a>
          </div>

        </div>
      </div>
    </div>
  </section>

</template>

<script>
export default {
  name: "ChallengeRow",
  props : ['challenge'],
  methods :{
    favoriteRequest(){
      axios.put(this.route("favorite.update" , this.challenge.id))
        .then(value => {
          this.toast("با موفقیت اضافه شد")
        }).catch(reason => {this.toast("عملیات با شکست مواجه شد" , "error")})
      .finally(() => {
        this.challenge.is_favorite = ! this.challenge.is_favorite;
      })
    }
  }
}
</script>

<style scoped>

</style>