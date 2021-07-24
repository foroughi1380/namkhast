<template>
  <fieldset class="form-label-group form-group position-relative has-icon-left">
    <input type="text" class="form-control" :id="name" :name="name" :placeholder="placeholder" :value="value" @input="$emit('input', $event.target.value)">
    <div class="form-control-position">
      <i :class="['feather' , icon]"></i>
    </div>
    <label :for="name" v-text="label"></label>
  </fieldset>
</template>

<script>
export default {
  name: "IconInputText",
  props : ['name' , 'icon' , 'placeholder' , 'label' , 'value']
}
</script>

<style scoped>

</style>