<template>
  <Head>
    <title>مشاهده جزئیات پیشنهاد</title>
  </Head>

  <section class="row">
    <!-- Challenge award -->
    <div class="card col-6 mx-auto">
      <div class="card-content row">
        <div class="card-body col-12 text-center">
          <div class="row">
            <div class="d-flex justify-content-center align-items-center mb-1 mx-auto">
              <div class="avatar mr-50">
                <img src="/theme/web/app-assets/images/portrait/small/avatar-s-5.jpg" alt="avtar img holder" height="75" width="75">
              </div>
              <div class="user-page-info">
                <h3 class="mb-0">نام کاربری</h3>
              </div>
            </div>
          </div>
          <div class="text-left my-2">
            <div class="col-12 mx-auto text-center my-4">
              <h5>نام پیشنهادی :</h5>
              <h1> نام</h1>
            </div>
          </div>

          <div class=" my-2">
            <div class="col-12 mx-auto text-center my-4">
              <h5>فایل صوتی تلفظ :</h5>
              <div class="col-md-12">
                <div class="card">
                  <!-- AUDIO -->
                  <audio id="plyr-audio-player" class="audio-player ml-4" controls>
                    <source src="https://cdn.plyr.io/static/demo/Kishi_Bashi_-_It_All_Began_With_a_Burst.mp3" type="audio/mp3" />
                  </audio>
                  <!-- AUDIO END -->
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mx-auto">
            <a class="btn btn-primary text-white">اعلام کاربر به عنوان برنده چالش</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</template>

<script>
import appLayout from "../../Shared/appLayout";

export default {
  name: "suggestDetail",
  layout: appLayout
}
</script>

<style scoped>

</style>