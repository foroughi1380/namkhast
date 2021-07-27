<template>
  <fieldset class="form-group col-3 mt-2">
    <div class="custom-file">
      <input type="file" class="custom-file-input" :id="name" :accept="accept" @input="inputChange" :value="modelValue">
      <label class="custom-file-label" :name="name" :for="name">{{label}}</label>
    </div>
  </fieldset>
</template>

<script>
export default {
  name: "SimpleInputFile",
  props : ["name" , "label" , "accept" , "modelValue"],
  methods:{
    inputChange(e){
      this.$emit('update:modelValue', e.target.files[0]);
    }
  }
}
</script>

<style scoped>

</style>