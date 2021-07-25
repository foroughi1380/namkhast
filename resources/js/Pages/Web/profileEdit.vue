<template>
<Head>
  <title>ویرایش پروفایل</title>
  <link rel="stylesheet" type="text/css" href="/theme/web/app-assets/css-rtl/pages/app-user.css">
</Head>

  <section class="users-edit">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">مشخصات</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                <i class="feather icon-info mr-25"></i><span class="d-none d-sm-block">احراز هویت</span>
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
              <!-- users edit media object start -->
              <div class="media mb-2">
                <a class="mr-2 my-25" href="#">
                  <img src="/theme/web/app-assets/images/portrait/small/avatar-s-18.jpg" alt="users avatar" class="users-avatar-shadow rounded" height="90" width="90">
                </a>
                <div class="media-body mt-50">
                  <h3 class="media-heading">نام و نام خانوادگی</h3>
                  <fieldset class="form-group col-3 mt-2">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="picture">
                      <label class="custom-file-label" name="picture" for="picture">انتخاب فایل</label>
                    </div>
                  </fieldset>
                </div>
              </div>
              <!-- users edit media object ends -->
              <!-- users edit account form start -->
              <form>
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <div class="controls">
                        <label>نام</label>
                        <input type="text" name="name" class="form-control" placeholder="نام" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="controls">
                        <label>نام خانوادگی</label>
                        <input type="text" name="family" class="form-control" placeholder="نام خانوادگی" value="" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="controls">
                        <label>شماره موبایل</label>
                        <input type="number" class="form-control" placeholder="شماره موبایل" value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                      ویرایش</button>
                    <button type="reset" class="btn btn-outline-warning">پاک کردن</button>
                  </div>
                </div>
              </form>
              <!-- users edit account form ends -->
            </div>
            <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
              <!-- users edit Info form start -->
              <form novalidate>
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="media mb-2">
                      <a class="mr-2 my-25" href="#">
                        <img src="/theme/web/app-assets/images/portrait/small/avatar-s-18.jpg" alt="nc_picture" class="users-avatar-shadow rounded" height="90" width="200">
                      </a>
                      <div class="media-body mt-50">
                        <h5 class="media-heading">لطفا جهت احراز هویت ، یک تصویر واضح از کارت ملی خود بارگذاری کنید.</h5>
                        <fieldset class="form-group col-12 mt-2">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="picture">
                            <label class="custom-file-label" name="picture" for="picture">انتخاب فایل</label>
                          </div>
                        </fieldset>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="controls">
                        <label>شماره شبا</label>
                        <input type="text" name="iban" class="form-control" placeholder="شماره شبا" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                      ویرایش</button>
                    <button type="reset" class="btn btn-outline-warning">پاک کردن</button>
                  </div>
                </div>
              </form>
              <!-- users edit Info form ends -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import appLayout from "../../Shared/appLayout";

export default {
  name: "profileEdit",
  layout: appLayout
}
</script>

<style scoped>

</style>