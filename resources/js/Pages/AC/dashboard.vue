<template>
  <Layout>
    <Head title="داشبورد"></Head>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>پنل مدیریت نام خواست</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">پنل مدیریت نام خواست</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content-body text-center">
      <h2>مدیر خوش آمدید</h2>
      <p>در این صفحه کمی از عملکرد سایت را مشاهده خواهید کرد.</p>
      <img src="/theme/AC/hero-img.png" alt="dashboard hero"/>

      <p class="mt-3 font-weight-bold">امار کلی</p>
      <section class="row mx-auto d-flex align-items-center justify-content-center container">

        <div class="card mx-auto">
          <div class="card-header">
            <h4>تعداد کاربران</h4>
          </div>
          <div class="card-body text-center">{{ userCount }}
          </div>
        </div>

        <div class="card mx-auto">
          <div class="card-header">
            <h4>تعداد کاربران جدید امروز</h4>
          </div>
          <div class="card-body text-center">{{ todayUserCount }}
          </div>
        </div>

        <div class="card mx-auto">
          <div class="card-header">
            <h4>تعداد چالش های امروز</h4>
          </div>
          <div class="card-body text-center">{{ todayChallengeCount }}
          </div>
        </div>

        <div class="card mx-auto">
          <div class="card-header">
            <h4>تعداد کل چالش ها</h4>
          </div>
          <div class="card-body text-center">{{ challengeCount }}
          </div>
        </div>

        <div class="card mx-auto">
          <div class="card-header">
            <h4>تعداد در خواست های احراض هویت</h4>
          </div>
          <div class="card-body text-center">{{ authReqCount }}
          </div>
        </div>

        <div class="card mx-auto">
          <div class="card-header">
            <h4>تعداد در خواست های برداشت</h4>
          </div>
          <div class="card-body text-center">{{ widReqCount }}
          </div>
        </div>

      </section>

      <section class="row">
        <!-- Line Chart -->
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">امار کاربران</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <div id="user-chart" class="ltr"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Line Area Chart -->
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">امار چالش ها</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <div id="challenge-chart"></div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </section>

  </Layout>
  <!-- /.card -->
</template>

<script>
import Layout from '../../Shared/ACLayout';
import ApexCharts from 'apexcharts'
export default {
  name: "dashboard",
  props: ['userCount','todayUserCount', 'challengeCount', 'todayChallengeCount', 'authReqCount' , 'widReqCount' , 'challengeChart' , 'userChart'],
  components: {Layout},
  mounted() {
    this.initCharts();
  },
  methods : {
    initCharts(){
      this.initChallengeChart();
      this.initUserChart();
    },

    initUserChart(){
      var options = {
        chart: {
          type: 'area'
        },
        series: [{
          name: 'تعداد کل کاربران',
          data: this.userChart.total
        },
          {
            name: 'تعداد کابران اضافه شده',
            data: this.userChart.new
          }],
        xaxis: {
          categories: this.convertGregorianArrayDateToJalaiArrayDate(this.userChart.date)
        }
      }

      var chart = new ApexCharts(document.querySelector("#user-chart"), options);

      chart.render();
    },
    initChallengeChart(){
      var options = {
        chart:{
          type: "area"
        },
        series: [{
          name: 'تعداد کل چالش ها',
          data: this.challengeChart.total
        },
          {
            name: 'تعداد چالش اضافه شده',
            data: this.challengeChart.new
          }],
        xaxis: {
          categories: this.convertGregorianArrayDateToJalaiArrayDate(this.challengeChart.date)
        }
      }

      var chart = new ApexCharts(document.querySelector("#challenge-chart"), options);

      chart.render();
    },
    convertGregorianArrayDateToJalaiArrayDate(dates){
      let ret = [];
      for (let date of dates) {
        ret.push(this.jalali(date))
      }
      return ret;
    }
  }
}
</script>

<style scoped>

</style>