<template>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
<!--      <ul class="navbar-nav mr-auto">-->
<!--        &lt;!&ndash; Messages Dropdown Menu &ndash;&gt;-->
<!--        <li class="nav-item dropdown">-->
<!--          <a class="nav-link" data-toggle="dropdown" href="#">-->
<!--            <i class="fa fa-comments-o"></i>-->
<!--            <span class="badge badge-danger navbar-badge">3</span>-->
<!--          </a>-->
<!--          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">-->
<!--            <a href="#" class="dropdown-item">-->
<!--              &lt;!&ndash; Message Start &ndash;&gt;-->
<!--              <div class="media">-->
<!--                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 ml-3 img-circle">-->
<!--                <div class="media-body">-->
<!--                  <h3 class="dropdown-item-title">-->
<!--                    حسام موسوی-->
<!--                    <span class="float-left text-sm text-danger"><i class="fa fa-star"></i></span>-->
<!--                  </h3>-->
<!--                  <p class="text-sm">با من تماس بگیر لطفا...</p>-->
<!--                  <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>-->
<!--                </div>-->
<!--              </div>-->
<!--              &lt;!&ndash; Message End &ndash;&gt;-->
<!--            </a>-->
<!--            <div class="dropdown-divider"></div>-->
<!--            <a href="#" class="dropdown-item">-->
<!--              &lt;!&ndash; Message Start &ndash;&gt;-->
<!--              <div class="media">-->
<!--                <img src="/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle ml-3">-->
<!--                <div class="media-body">-->
<!--                  <h3 class="dropdown-item-title">-->
<!--                    پیمان احمدی-->
<!--                    <span class="float-left text-sm text-muted"><i class="fa fa-star"></i></span>-->
<!--                  </h3>-->
<!--                  <p class="text-sm">من پیامتو دریافت کردم</p>-->
<!--                  <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>-->
<!--                </div>-->
<!--              </div>-->
<!--              &lt;!&ndash; Message End &ndash;&gt;-->
<!--            </a>-->
<!--            <div class="dropdown-divider"></div>-->
<!--            <a href="#" class="dropdown-item">-->
<!--              &lt;!&ndash; Message Start &ndash;&gt;-->
<!--              <div class="media">-->
<!--                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle ml-3">-->
<!--                <div class="media-body">-->
<!--                  <h3 class="dropdown-item-title">-->
<!--                    سارا وکیلی-->
<!--                    <span class="float-left text-sm text-warning"><i class="fa fa-star"></i></span>-->
<!--                  </h3>-->
<!--                  <p class="text-sm">پروژه اتون عالی بود مرسی واقعا</p>-->
<!--                  <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>4 ساعت قبل</p>-->
<!--                </div>-->
<!--              </div>-->
<!--              &lt;!&ndash; Message End &ndash;&gt;-->
<!--            </a>-->
<!--            <div class="dropdown-divider"></div>-->
<!--            <a href="#" class="dropdown-item dropdown-footer">مشاهده همه پیام‌ها</a>-->
<!--          </div>-->
<!--        </li>-->
<!--        &lt;!&ndash; Notifications Dropdown Menu &ndash;&gt;-->
<!--        <li class="nav-item dropdown">-->
<!--          <a class="nav-link" data-toggle="dropdown" href="#">-->
<!--            <i class="fa fa-bell-o"></i>-->
<!--            <span class="badge badge-warning navbar-badge">15</span>-->
<!--          </a>-->
<!--          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">-->
<!--            <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>-->
<!--            <div class="dropdown-divider"></div>-->
<!--            <a href="#" class="dropdown-item">-->
<!--              <i class="fa fa-envelope ml-2"></i> 4 پیام جدید-->
<!--              <span class="float-left text-muted text-sm">3 دقیقه</span>-->
<!--            </a>-->
<!--            <div class="dropdown-divider"></div>-->
<!--            <a href="#" class="dropdown-item">-->
<!--              <i class="fa fa-users ml-2"></i> 8 درخواست دوستی-->
<!--              <span class="float-left text-muted text-sm">12 ساعت</span>-->
<!--            </a>-->
<!--            <div class="dropdown-divider"></div>-->
<!--            <a href="#" class="dropdown-item">-->
<!--              <i class="fa fa-file ml-2"></i> 3 گزارش جدید-->
<!--              <span class="float-left text-muted text-sm">2 روز</span>-->
<!--            </a>-->
<!--            <div class="dropdown-divider"></div>-->
<!--            <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>-->
<!--          </div>-->
<!--        </li>-->

<!--      </ul>-->
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/ac" class="brand-link text-center">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <div>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->

              <li class="nav-item">
                <Link :href="route('ac.dashboard')" class="nav-link">
                  <i class="nav-icon fa fa-dashboard"></i>
                  <p>
                    داشبورد
                  </p>
                </Link>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-user"></i>
                  <p>
                    کاربران
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <Link :href="route('ac.user.index')" class="nav-link">

                      <i class="fa fa-users nav-icon"></i>
                      <p>لیست کاربران</p>

                    </Link>
                  </li>
                  <li class="nav-item">
                    <Link :href="route('ac.authRequest.index')" class="nav-link">
                      <i class="fa fa-key nav-icon"></i>
                      <p>درخواست های احراز هویت</p>
                    </Link>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    ادمین ها
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <Link :href="route('ac.admin.create')" class="nav-link">
                      <i class="fa fa-user-plus nav-icon"></i>
                      <p>افزودن ادمین</p>
                    </Link>
                  </li>
                  <li class="nav-item">
                    <Link :href="route('ac.admin.index')" class="nav-link">
                      <i class="fa fa-list nav-icon"></i>
                      <p>لیست ادمین ها</p>
                    </Link>
                  </li>
                </ul>
              </li>

<!--              <li class="nav-item has-treeview">-->
<!--                <a href="#" class="nav-link">-->
<!--                  <i class="nav-icon fa fa-trophy"></i>-->
<!--                  <p>-->
<!--                    چالش ها-->
<!--                    <i class="right fa fa-angle-left"></i>-->
<!--                  </p>-->
<!--                </a>-->
<!--                <ul class="nav nav-treeview">-->
<!--                  <li class="nav-item">-->
<!--                    <Link href="#" class="nav-link">-->
<!--                      <i class="fa fa-list nav-icon"></i>-->
<!--                      <p>لیست چالش ها</p>-->
<!--                    </Link>-->
<!--                  </li>-->

<!--                  <li class="nav-item">-->
<!--                    <Link href="#" class="nav-link">-->
<!--                      <i class="fa fa-plus nav-icon"></i>-->
<!--                      <p>افزودن چالش</p>-->
<!--                    </Link>-->
<!--                  </li>-->
<!--                </ul>-->
<!--              </li>-->

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-money"></i>
                  <p>
                    امور مالی
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <Link :href="route('ac.authRequest.index')" class="nav-link">
                      <i class="fa fa-level-up nav-icon"></i>
                      <p>درخواست های برداشت</p>
                    </Link>
                  </li>
                  <li class="nav-item">
                    <Link href="#" class="nav-link">
                      <i class="fa fa-list nav-icon"></i>
                      <p>لیست تراکنش ها</p>
                    </Link>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-gears"></i>
                  <p>
                    تنظیمات سایت
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <Link :href="route('ac.config.index')" class="nav-link">
                      <i class="fa fa-gear nav-icon"></i>
                      <p>پیکربندی</p>
                    </Link>
                  </li>
                </ul>
              </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->


      <!-- Main content -->
      <section class="content">
        <slot />
      </section>
      <!-- /.content -->
    </div>


    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
</template>

<script>
export default {
name: "ACLayout"
}
</script>

<style scoped>

</style>