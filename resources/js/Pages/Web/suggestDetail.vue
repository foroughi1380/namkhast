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
                <img :src="user.picture" alt="avtar img holder" height="75" width="75">
              </div>
              <div class="user-page-info">
                <h3 class="mb-0">{{ user.name}} {{ user.family }}</h3>
              </div>
            </div>
          </div>
          <div class="text-left my-2">
            <div class="col-12 mx-auto text-center my-4">
              <h5>نام پیشنهادی :</h5>
              <h1> {{ suggest.suggested_name }}</h1>
            </div>
          </div>

          <div class="text-left my-2" v-if="suggest.description">
            <div class="col-12 mx-auto text-center my-4">
              <h5>توضیحات :</h5>
              <p> {{ suggest.description }}</p>
            </div>
          </div>

          <div class=" my-2" v-if="suggest.sound">
            <div class="col-12 mx-auto text-center my-4">
              <h5>فایل صوتی تلفظ :</h5>
              <div class="col-md-12">
                <div class="card">
                  <!-- AUDIO -->
                  <audio id="plyr-audio-player" class="audio-player ml-4" controls>
                    <source :src="suggest.sound" type="audio/mp3" />
                  </audio>
                  <!-- AUDIO END -->
                  <p class="text-danger " v-for="error in errors" v-text="error"></p>

                </div>
              </div>
            </div>
          </div>
          <div class="text-center mx-auto">
            <WaitButton text="اعلام کاربر به عنوان برنده چالش" :wait="inProcess" :on-click="choiceWinner" :disabled="inProcess"/>

          </div>
        </div>
      </div>
    </div>
  </section>

</template>

<script>
import appLayout from "../../Shared/appLayout";
import {Inertia} from "@inertiajs/inertia";
import WaitButton from "../../Shared/Components/WaitButton";

export default {
  name: "suggestDetail",
  layout: appLayout,
  components : { WaitButton },
  data() {
    return {
      winnerUser: "",
      token: "",
      inProcess: false
    }
  },
  props: {
    user: {},
    suggest: {},
    errors: {}
  },
  methods:{
    choiceWinner(){
      console.log('hi')
        this.inProcess = true;

        this.generateRecaptchaToken('choiceWinner').then(token => {

          Inertia.post(this.route('challenge.winner' , this.$props.suggest.id), {
            winnerUser: this.$props.suggest.user_id,
            token:token,
          }, {
            onSuccess: page => {
              this.toast("کاربر به عنوان برنده اعلام شد" , "success")
            },
            onFinish: visit => {
              this.inProcess = false;
            }
          })
        });
      }
  }
}
</script>

<style scoped>

</style>