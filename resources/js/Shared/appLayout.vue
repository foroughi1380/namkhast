<template>

  <!-- BEGIN: Header-->
  <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-container content">
        <div class="navbar-collapse" id="navbar-mobile">
          <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">

            <ul class="nav navbar-nav">
              <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
            </ul>

            <ul class="nav navbar-nav bookmark-icons">
<!--              <li class="dropdown dropdown-notification nav-item">-->
<!--                <a class="nav-link nav-link-label" href="#" data-toggle="dropdown" title="پیام های شما">-->
<!--                  <i-->
<!--                  class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up">1</span></a>-->
<!--                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-left">-->
<!--                  <li class="dropdown-menu-header">-->
<!--                    <div class="dropdown-header m-0 p-2">-->
<!--                      <h3 class="notification-title">پیام های شما</h3>-->
<!--                    </div>-->
<!--                  </li>-->
<!--                  <li class="scrollable-container media-list">-->


<!--                    <a class="d-flex justify-content-between"-->
<!--                       href="javascript:void(0)">-->
<!--                      <div class="media d-flex align-items-start">-->
<!--                        <div class="media-left"><i class="feather icon-plus-square font-medium-5 success"></i></div>-->
<!--                        &lt;!&ndash; success   danger    info   warning &ndash;&gt;-->
<!--                        <div class="media-body">-->
<!--                          <h6 class="primary media-heading">چالش شما با موفقیت ثبت شد.</h6>-->
<!--                          <small class="notification-text"></small>-->
<!--                        </div>-->
<!--                        <small>-->
<!--                          <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">10 ساعت پیش</time>-->
<!--                        </small>-->
<!--                      </div>-->
<!--                    </a>-->


<!--                  </li>-->
<!--                  <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">مشاهده تمام پیام ها</a></li>-->
<!--                </ul>-->
<!--              </li>-->

              <li class="nav-item d-none d-lg-block"><Link class="nav-link bookmark-star" title="مورد علاقه ها" :href="route('favorite.index')"><i
                  class="ficon feather icon-star"></i>
              </Link>
              </li>

              <li class="nav-item d-none d-lg-block"><Link class="nav-link bookmark-star" title="چالش ها" :href="route('challenges')"><i
                  class="ficon feather icon-award"></i>
              </Link>
              </li>

              <li class="nav-item d-lg-block dropdown">
                <a class="dropdown-toggle nav-link font-size-2"  data-toggle="dropdown">
                  <span class="ficon feather icon-dollar-sign"></span>
                  <span>اعتبار شما : </span>
                  <span v-text="wallet"></span>
                  <span> تومان </span>
                </a>


                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" data-toggle="modal" data-target="#chargeModal"><i class="feather icon-plus"></i>شارژ حساب</a>
                  <div class="dropdown-divider"></div>
                  <Link class="dropdown-item" href="/withdraw"><i class="feather icon-chevron-right"></i>درخواست برداشت</Link>
                </div>
              </li>
            </ul>


          </div>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item" v-if="isLogin">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <div class="user-nav d-sm-flex d-none">
                  <span class="user-name text-bold-600">{{ user.name }}  {{ user.family }}</span>
                  <span class="user-status" v-text="user.phone"></span>
                </div>
                <span>
                <img class="round" :src="user.picture" alt="avatar"
                     height="40" width="40" v-if="user && user.picture">
                <img class="round" src="/theme/web/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar"
                     height="40" width="40" v-else>
              </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" :href="route('user.index')"><i class="feather icon-user"></i> پروفایل </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout"><i class="feather icon-power"></i> خارج شدن</a>
              </div>
            </li>

            <li v-else>
              <a href="/login" class="btn bg-gradient-primary mt-1 mr-1 mb-1 ml-1 waves-effect waves-light">ورود</a>
              <a href="/register" class="btn bg-gradient-success mt-1 mr-1 mb-1 waves-effect waves-light">ثبت نام</a>
            </li>


          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- END: Header-->


  <!-- BEGIN: Main Menu-->
  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto">
          <Link class="navbar-brand" href="/">
            <img src="/theme/web/app-assets/images/logo/logo.png" width="30" height="27">
<!--            <div class="brand-logo"></div>-->
            <h2 class="brand-text mb-0">نام خواست</h2>
          </Link>
        </li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
            class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
            class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
            data-ticon="icon-disc"></i></a></li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item active">
          <Link href="/"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">خانه</span>
          </Link>
        </li>
        <li class=" navigation-header"><span>دسترسی سریع</span>
        </li>
        <li class=" nav-item">
          <Link href="/profile"><i class="feather icon-user"></i><span class="menu-title"
                                                                       data-i18n="Email">پروفایل من</span></Link>
        </li>
        <li class=" nav-item">
          <Link :href="route('challenges')"><i class="feather icon-award"></i><span class="menu-title"
                                                                                         data-i18n="Chat">چالش ها</span>
          </Link>
        </li>
        <li class=" nav-item">
          <Link :href="route('contributors')"><i class="feather icon-check-square"></i><span class="menu-title" data-i18n="Todo">شرکت شده ها</span>
          </Link>
        </li>
        <li class=" nav-item">
          <Link href="/favorites"><i class="feather icon-star"></i><span class="menu-title" data-i18n="Calender">مورد علاقه ها</span>
          </Link>
        </li>
        <li class=" nav-item">
          <Link href="/about"><i class="feather icon-help-circle"></i><span class="menu-title" data-i18n="Calender">درباره ما</span>
          </Link>
        </li>

        <li class=" navigation-header"><span>چالش ها</span>
        </li>
        <li class=" nav-item">
          <Link :href="route('challenge.create')"><i class="feather icon-plus-circle"></i><span class="menu-title"
                                                                                                data-i18n="Calender">ثبت چالش</span>
          </Link>
        </li>
        <li class=" nav-item">
          <Link :href="route('challenge.index')"><i class="feather icon-user-check"></i><span class="menu-title"
                                                                                           data-i18n="Calender">چالش های من</span>
          </Link>
        </li>

        <li class=" navigation-header"><span>ناحیه کاربری</span>
        </li>
        <li class=" nav-item">
          <Link href="/profile/edit"><i class="feather icon-edit"></i><span class="menu-title" data-i18n="Calender">ویرایش پروفایل</span>
          </Link>
        </li>
        <li class=" nav-item">
          <Link href="/withdraw"><i class="feather icon-arrow-up"></i><span class="menu-title" data-i18n="Calender">درخواست برداشت</span>
          </Link>
        </li>
        <li class=" nav-item">
          <Link href="/withdraw/track"><i class="feather icon-search"></i><span class="menu-title" data-i18n="Calender">پیگیری درخواست ها</span>
          </Link>
        </li>

      </ul>
    </div>
  </div>
  <!-- END: Main Menu-->

  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <!--      <div class="content-header row">-->
      <!--        <div class="content-header-left col-md-9 col-12 mb-2">-->
      <!--          <div class="row breadcrumbs-top">-->
      <!--            <div class="col-12">-->
      <!--              <h2 class="content-header-title float-left mb-0">صفحه اصلی</h2>-->
      <!--              <div class="breadcrumb-wrapper col-12">-->
      <!--                <ol class="breadcrumb">-->
      <!--                  <li class="breadcrumb-item"><a href="index.html">Home</a>-->
      <!--                  </li>-->
      <!--                  <li class="breadcrumb-item"><a href="#">Pages</a>-->
      <!--                  </li>-->
      <!--                  <li class="breadcrumb-item active">Invoice-->
      <!--                  </li>-->
      <!--                </ol>-->
      <!--              </div>-->
      <!--            </div>-->
      <!--          </div>-->
      <!--        </div>-->

      <!--      </div>-->

      <!-- Main Content -->
      <div class="content-body">
        <slot/>
      </div>
      <!-- End: Main Content -->

      <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-white">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <section class="container d-flex flex-column text-center">
                <section class="fa fa-money text-secondary"  style="font-size: 6rem"/>
                <section class="mt-1">
                  <span class="text">
                    مبلغ:
                  </span>
                  <span class="font-size-large" id="payModalPrice"></span>
                  <span class="font-size-xsmall text-light">
                    تومان
                  </span>
                </section>
                <hr class="w-50"/>
                <p id="payModalDescription"></p>
                <a id="payModalUrl">
                  <button type="button" class="btn btn-primary">اتصال به درگاه پرداخت</button>
                </a>
                <p class="mt-1">و یا</p>
                <a id="payModalUrlFromWallet">
                  <button type="button" class="btn btn-secondary btn-sm">پرداخت با حساب کاربری</button>
                </a>
              </section>
            </div>
            <div class="modal-footer justify-content-center text-light">
              پرداخت امن
              pay.ir
            </div>
          </div>
        </div>
      </div>



      <!-- wallet charge -->
      <div class="modal fade" id="chargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-white">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <section class="container d-flex flex-column text-center">
                <section class="fa fa-money text-secondary"  style="font-size: 6rem"/>
                <p>شارژ حساب</p>
                <hr class="w-50"/>
                <section class="mt-1">
                  <span class="text">
                    مبلغ:
                  </span>
                  <input type="number" step="100" min="0" max="10000000" class="font-size-large" v-model="walletChargePrice">
                  <span class="font-size-xsmall text-light">
                    تومان
                  </span>
                </section>
                <hr class="w-50"/>
                <p> شما میتونید حد اقل ۵,۰۰۰ تومان و حداکثر تا  ۱,۰۰۰,۰۰۰ حساب کاربری خود را شارژ کنید</p>
                <a>
                  <WaitButton :on-click="walletCharge" text="اتصال به درگاه پرداخت" :wait="inProgress"/>
                </a>
              </section>
            </div>
            <div class="modal-footer justify-content-center text-light">
              پرداخت امن
              pay.ir
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
  <!-- END: Content-->


</template>

<script>
import {Inertia} from "@inertiajs/inertia";
import WaitButton from "./Components/WaitButton";

export default {
  name: "appLayout",
  components: {WaitButton},
  props: ['isLogin', 'user' , 'wallet'],
  data(){
    return {
      walletChargePrice : 5000,
      inProgress : false,
    }
  },
  methods :{
    walletCharge(){
      if (this.walletChargePrice < 5000 || this.walletChargePrice > 1000000){
        this.toast("حداقل مقدار واریزی ۵۰۰۰ تومان و حد اکثر ۱,۰۰۰,۰۰۰ میباشد." , "error");
      }else if (! /^[1-9][0-9]+00/.test(this.walletChargePrice)){
        this.toast("مبلغ وارد شده باید بر ۱۰۰ بخش پذیر باشد." , "error");
      }else{
        this.inProgress = true;
        Inertia.get(this.route("walletCharge" , this.walletChargePrice) , {} , {
          onError: err => {
            this.toast(err.price , 'error');
          },
          onFinish : attr=>{
            this.inProgress = false;
          }
        });
      }
    }
  },
  created() {
    if (this.errors){
      Object.values(this.errors).forEach(value => {
        if ((typeof value) !== "object")
          this.toast(value, 'error');
      })

      if (this.errors.success){
        Object.values(this.errors.success).forEach(value => {
          this.toast(value);
        })
      }
    }
  }
}
</script>

<style scoped>

</style>