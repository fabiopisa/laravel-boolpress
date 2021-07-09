<template>
  <div 
  class="card mb-3">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h5 class="card-title">{{title}}</h5>
        <span class="badge badge-success custom-badge">{{category}}</span>
      </div>
      <i>{{date}}</i>
      <p class="card-text">{{truncateTex}}.</p>
      <router-link class="btn btn-primary" :to="{name:'pagedetail',params:{slug}}">
        Vai
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Card',

  props:['title','category','date','content','slug'],

  data(){
    return{
      maxLengthTex:150
    }
  },
  computed:{
    truncateTex(){
      let text = this.content;
      if(text.length > this.maxLengthTex){
        text = text.substr(0, this.maxLengthTex) + '...';
      }
      return text;
    }
  }

}
</script>

<style>

</style>