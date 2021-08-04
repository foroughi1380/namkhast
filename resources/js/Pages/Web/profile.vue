<template>
  <Head title="پروفایل کاربر"></Head>
  <div id="user-profile">
    <div class="row">
      <div class="col-12">
        <div class="profile-header mb-2">
          <div class="relative">
            <div class="profile-img-container d-flex align-items-center justify-content-center">
              <img :src="user.picture"
                   class="rounded-circle img-border box-shadow-1" alt="Card image" v-if="user.picture" width="300" height="300">

              <img src="/theme/web/app-assets/images/profile/user-uploads/user-13.jpg"
                   class="rounded-circle img-border box-shadow-1" alt="Card image" width="300" height="300" v-else>
            </div>
          </div>

          <div class="mt-3 d-flex align-items-center justify-content-center">
            <h3 class="m-1">{{ user.name }} {{user.family}}</h3>
<!--            <button type="button" class="btn btn-icon btn-icon rounded-circle btn-primary mr-1">-->
<!--              <i class="feather icon-edit-2"></i>-->
<!--            </button>-->
          </div>
        </div>
      </div>
    </div>
    <!--Info-->
<!--    <section class="row mx-auto d-flex align-items-center justify-content-center">-->
<!--      <div class="card mx-auto">-->
<!--        <div class="card-header">-->
<!--          <h4>مجموع برنده شده</h4>-->
<!--        </div>-->
<!--        <div class="card-body text-center">15000 تومان-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="card mx-auto">-->
<!--        <div class="card-header ">-->
<!--          <h4>تعداد چالش کاربر</h4>-->
<!--        </div>-->
<!--        <div class="card-body text-center">8-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="card mx-auto">-->
<!--        <div class="card-header">-->
<!--          <h4>چالش های برنده شده</h4>-->
<!--        </div>-->
<!--        <div class="card-body text-center">3-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="card mx-auto">-->
<!--        <div class="card-header">-->
<!--          <h4>چالش های تمام شده</h4>-->
<!--        </div>-->
<!--        <div class="card-body text-center">14-->
<!--        </div>-->
<!--      </div>-->
<!--    </section>-->
    <!--Info-->
    <section id="profile-info">
      <div class="row">
        <!-- Biography -->
        <div class="col-12">
          <div class="card">
<!--            <div class="card-header">-->
<!--              <h4>بیوگرافی</h4>-->
<!--            </div>-->
            <div class="card-body">
              <div class="mt-1">
                <h6 class="mb-0">تاریخ عضویت:</h6>
                <p>{{jalali(user.created_at.split(" ")[0])}}</p>
              </div>
              <div class="mt-1">
                <h6 class="mb-0">شماره تماس:</h6>
                <p>{{ user.phone}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--END: Biography  -->

      <!--Challenge -->
<!--      <h3 class="my-3">آخرین چالش های برنده شده</h3>-->
<!--      <section class="row">-->
<!--        <div class="col-md-3 col-sm-12">-->
<!--          <div class="card ecommerce-card">-->
<!--            <div class="card-content">-->
<!--              <div class="item-img text-center">-->
<!--                <a href="app-ecommerce-details.html">-->
<!--                  <img class="img-fluid" src="/theme/web/app-assets/images/pages/eCommerce/1.png" alt="img-placeholder"></a>-->
<!--              </div>-->
<!--              <div class="card-body">-->
<!--                <div class="item-name">-->
<!--                  <h4>نام چالش</h4>-->
<!--                </div>-->
<!--                <div>-->
<!--                  <p class="item-description">-->
<!--                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده-->
<!--                  </p>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="item-options text-center">-->
<!--                <div class="item-wrapper">-->
<!--                  <div class="item-cost">-->
<!--                    <h6 class="item-price">-->
<!--                      مبلغ جایزه : 10000 تومان-->
<!--                    </h6>-->
<!--                  </div>-->
<!--                </div>-->
<!--                <a href="#" class="btn btn-info btn-block mt-3">مشاهده جزئیات</a>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="col-md-3 col-sm-12">-->
<!--          <div class="card ecommerce-card">-->
<!--            <div class="card-content">-->
<!--              <div class="item-img text-center">-->
<!--                <a href="app-ecommerce-details.html">-->
<!--                  <img class="img-fluid" src="/theme/web/app-assets/images/pages/eCommerce/1.png" alt="img-placeholder"></a>-->
<!--              </div>-->
<!--              <div class="card-body">-->
<!--                <div class="item-name">-->
<!--                  <h4>نام چالش</h4>-->
<!--                </div>-->
<!--                <div>-->
<!--                  <p class="item-description">-->
<!--                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده-->
<!--                  </p>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="item-options text-center">-->
<!--                <div class="item-wrapper">-->
<!--                  <div class="item-cost">-->
<!--                    <h6 class="item-price">-->
<!--                      مبلغ جایزه : 10000 تومان-->
<!--                    </h6>-->
<!--                  </div>-->
<!--                </div>-->
<!--                <a href="#" class="btn btn-info btn-block mt-3">مشاهده جزئیات</a>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="col-md-3 col-sm-12">-->
<!--          <div class="card ecommerce-card">-->
<!--            <div class="card-content">-->
<!--              <div class="item-img text-center">-->
<!--                <a href="app-ecommerce-details.html">-->
<!--                  <img class="img-fluid" src="/theme/web/app-assets/images/pages/eCommerce/1.png" alt="img-placeholder"></a>-->
<!--              </div>-->
<!--              <div class="card-body">-->
<!--                <div class="item-name">-->
<!--                  <h4>نام چالش</h4>-->
<!--                </div>-->
<!--                <div>-->
<!--                  <p class="item-description">-->
<!--                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده-->
<!--                  </p>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="item-options text-center">-->
<!--                <div class="item-wrapper">-->
<!--                  <div class="item-cost">-->
<!--                    <h6 class="item-price">-->
<!--                      مبلغ جایزه : 10000 تومان-->
<!--                    </h6>-->
<!--                  </div>-->
<!--                </div>-->
<!--                <a href="#" class="btn btn-info btn-block mt-3">مشاهده جزئیات</a>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="col-md-3 col-sm-12">-->
<!--          <div class="card ecommerce-card">-->
<!--            <div class="card-content">-->
<!--              <div class="item-img text-center">-->
<!--                <a href="app-ecommerce-details.html">-->
<!--                  <img class="img-fluid" src="/theme/web/app-assets/images/pages/eCommerce/1.png" alt="img-placeholder"></a>-->
<!--              </div>-->
<!--              <div class="card-body">-->
<!--                <div class="item-name">-->
<!--                  <h4>نام چالش</h4>-->
<!--                </div>-->
<!--                <div>-->
<!--                  <p class="item-description">-->
<!--                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده-->
<!--                  </p>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="item-options text-center">-->
<!--                <div class="item-wrapper">-->
<!--                  <div class="item-cost">-->
<!--                    <h6 class="item-price">-->
<!--                      مبلغ جایزه : 10000 تومان-->
<!--                    </h6>-->
<!--                  </div>-->
<!--                </div>-->
<!--                <a href="#" class="btn btn-info btn-block mt-3">مشاهده جزئیات</a>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </section>-->
      <!--END: Challenge -->
    </section>
  </div>
</template>

<script>
import appLayout from "../../Shared/appLayout";

export default {
  name: "profile",
  layout: appLayout,
  props:['user']
}
</script>

<style scoped>

</style>