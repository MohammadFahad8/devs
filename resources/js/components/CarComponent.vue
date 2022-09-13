<template>
  <div>
  <div class="alert alert-info">{{this.count}}</div>
    <button class="btn btn-dark" @click="sendToFather">Send to Father</button>
  </div>
</template>
<script>
  export default{
    props:['count'],
    mounted(){
      console.log(this.count)
    },
    data(){
      return{
        myMessage:"Hey Papa"
      }
    },
    methods:{
      sendToFather:function()
      {
        this.$emit("childMessage",this.myMessage)
      }
    }
  }
</script>
