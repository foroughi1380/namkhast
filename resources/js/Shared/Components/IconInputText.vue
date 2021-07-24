<template>
  <fieldset class="form-label-group form-group position-relative has-icon-left">
    <input :type="type ? type : 'text'" class="form-control" :id="name" :name="name" :placeholder="placeholder" :value="modelValue" @input="inputChange">
    <div class="form-control-position">
      <i :class="['feather' , icon]"></i>
    </div>
    <label :for="name" v-text="label"></label>
  </fieldset>
</template>

<script>
export default {
  name: "IconInputText",
  props : ['name' , 'icon' , 'placeholder' , 'label' , 'modelValue' , 'type'],
  methods:{
    inputChange(e){
      this.$emit('update:modelValue', e.target.value);
    }
  }
}
</script>

<style scoped>

</style>