<template>
  <Head title="پروفایل کاربر"></Head>
  <div class="container card">
    <div class="row">
      <div class="col-12">
        <div class="profile-header mb-2">
          <div class="relative">
            <div class="profile-img-container d-flex align-items-center justify-content-center m-2">
              <img :src="specificUser.picture"
                   class="rounded-circle img-border box-shadow-1" alt="Card image" v-if="specificUser.picture" width="300" height="300">

              <img src="/theme/web/app-assets/images/profile/user-uploads/user-13.jpg"
                   class="rounded-circle img-border box-shadow-1" alt="Card image" width="300" height="300" v-else>
            </div>
          </div>

          <div class="mt-3 d-flex align-items-center justify-content-center">
            <h3 class="m-1">{{ specificUser.name }} {{specificUser.family}}</h3>
<!--            <button type="button" class="btn btn-icon btn-icon rounded-circle btn-primary mr-1">-->
<!--              <i class="feather icon-edit-2"></i>-->
<!--            </button>-->
          </div>
<!--        <div class="text-center">-->
<!--          <span class="text-black-50"> تاریخ عضویت : </span>-->
<!--          <span class="text-black-50 ltr"> {{jalali(specificUser.created_at)}} </span>-->
<!--          <span class="text-black-50"> شماره تماس : {{specificUser.phone}} </span>-->
<!--        </div>-->
        </div>
      </div>
    </div>
    <!--Info-->
    <section class="row mx-auto d-flex align-items-center justify-content-center">
      <div class="card mx-auto">
        <div class="card-header ">
          <h4>تعداد چالش کاربر</h4>
        </div>
        <div class="card-body text-center">{{ challengeCount }}
        </div>
      </div>
      <div class="card mx-auto">
        <div class="card-header">
          <h4>چالش های برنده شده</h4>
        </div>
        <div class="card-body text-center">{{winnerCount}}
        </div>
      </div>
    </section>

    <div class="text-center m-2">
      <span class="text-black-50"> تاریخ عضویت : </span>
      <p class="text-black-50 d-inline-block"> {{jalali(specificUser.created_at)}} </p>
      <span class="text-black-50"> شماره تماس : {{specificUser.phone}} </span>
    </div>
  </div>
</template>

<script>
import appLayout from "../../Shared/appLayout";

export default {
  name: "profile",
  layout: appLayout,
  props:['specificUser' , 'winnerCount' , 'challengeCount']
}
</script>

<style scoped>

</style>