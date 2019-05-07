<template>
    <div class="bg-container">
        <!-- 背景图 -->
      <Backpic></Backpic>
      <!-- 头部导航 -->
      <HeaderTitle @formData="formData"></HeaderTitle>
      <!-- 轮播 -->
      <Slideshow></Slideshow>
      <!-- 底部导航 -->
      <!-- <FooterGuide></FooterGuide> -->

      <!-- <Transition v-show='Loading'></Transition> -->
    </div>
</template>

<script>
  import Backpic from '../common/datacenter/Backpic.vue'
  import HeaderTitle from '../common/datacenter/HeaderTitle.vue'
  import FooterGuide from '../common/datacenter/FooterGuide.vue'
  import Slideshow from '../common/datacenter/Slideshow.vue'
  // import Transition from './common/Transition.vue'

  export default{
    name:"DataCenter",
    components:{
      "Backpic":Backpic,
      "HeaderTitle":HeaderTitle,
      "FooterGuide":FooterGuide,
      "Slideshow":Slideshow,
      // "Transition":Transition,
    },
    data(){
      return{
        Loading:false
      }
    },
    methods:{
      formData(data){
        this.Loading = data;
        var that = this;
        setTimeout(function() {
          that.$router.push({ path:'/Backstage'});
        }, 2000);
      }
    },
    mounted(){
    },
    // mixins:[draw],

  }
</script>

<style scoped>
  @import '../../assets/css/normalize.css';
/*   body * {
      -webkit-transform-style: preserve-3d;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
      transform-style: preserve-3d;
    } */
  .bg-container{
    position: relative;
    width: 100%;
    height: 100%;
    overflow:hidden;
    background: #000;
    -webkit-perspective: 700;
    overflow: hidden;
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
   /* min-height: 720px; */
  }

  @-webkit-keyframes shineBlue{
    from{-webkit-box-shadow:0 0 9px #333;}  
    50%{-webkit-box-shadow:0 0 20px #1E7FDB}
    to{-webkit-box-shadow:0 0 9px #333;}
  }
  @keyframes shineBlue{
    from{box-shadow:0 0 9px #333;}  
    50%{box-shadow:0 0 20px #1E7FDB}
    to{box-shadow:0 0 9px #333;}
  }
</style>