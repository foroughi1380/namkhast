<template xmlns="http://www.w3.org/1999/html">
  <Head>
    <title>شرکت در چالش</title>
  </Head>

  <section>
    <section class="row">
      <!-- Challenge award -->
      <div class="card col-12 mx-auto">
        <div class="card-content row">
          <div class="card-body col-12 text-center">
            <div class="row">
              <h3 class="col-6"><span class="fa fa-trophy"> </span>{{ challenge.budget }} تومان </h3>
              <h3 class="col-6">هزینه مشارکت : {{ challenge.cost }}</h3>
            </div>
            <div class="text-left my-2">
              <div class="col-12">
                <div class="form-group">
                  <label for="name">نام پیشنهادی</label>
                  <input name="name" type="text" class="form-control" id="name" v-model="name" :disabled="inProcess">
                  <p class="text-danger text-sm" v-if="errors.name" v-text="errors.name"></p>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label for="description">توضیحات اضافی</label>
                  <textarea name="description" id="description" rows="5" class="form-control" v-model="description"
                            :disabled="inProcess"></textarea>
                  <p class="text-danger text-sm" v-if="errors.description" v-text="errors.description"></p>
                </div>
              </div>

              <div class="col-5">
                <fieldset class="form-group">
                  <label for="picture">تلفظ نام</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="name_voice" @input="soundDetected"
                           :disabled="inProcess">
                    <label class="custom-file-label" name="extras" for="name_voice">انتخاب فایل صوتی تلفظ نام</label>
                    <p class="text-danger text-sm" v-if="errors.sound" v-text="errors.sound"></p>
                  </div>
                </fieldset>
              </div>
              <p class="text-danger text-sm" v-if="errors.token" v-text="errors.token"></p>
              <p class="text-danger text-sm" v-if="errors.unknown" v-text="errors.unknown"></p>
            </div>
            <div>
              <a class="btn btn-primary btn-block text-white" @click="submit">ارسال نام</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
import appLayout from "../../Shared/appLayout";
import {Inertia} from "@inertiajs/inertia";

export default {
  name: "challengeParticipants",
  props: ["challenge", "contributor", "errors"],
  layout: appLayout,
  data() {
    return {
      name: this.contributor.suggested_name,
      description: this.contributor.description,
      sound: null,
      inProcess: false,
    }
  },
  methods: {
    soundDetected(e) {
      this.sound = e.target.files[0];
    },
    submit() {
      this.inProcess = true;
      let data = {
        name: this.name,
        description: this.description
      };
      if (this.sound) {
        data.sound = this.sound;
      }
      this.generateRecaptchaToken("cup").then(value => {
        data.token = value;
        Inertia.post(this.route("contributor.update", this.contributor.id), data, {
          onSuccess: params => {
            this.toast("با موفقیت ثبت شد");
          },
          onError: err => {
            this.toast("خطا ها  را برسی کنید", "error")
          },
          onFinish: params => {
            this.inProcess = false;
          }
        })
      })
    }
  }
}
</script>

<style scoped>

</style>