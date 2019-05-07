<!--
  describe："科技感头部导航标题"
  created by：Jiang Duosheng
-->
<template>
	<div class="header-container">
      <svg class="icon-right" aria-hidden="true">
        <use xlink:href="#icon-right-line"></use>
      </svg>
      <svg class="icon-bulit" aria-hidden="true">
        <use xlink:href="#icon-Building-"></use>
      </svg>
      <div class="header-title">
      系统数据中心
      </div>
      <div class="header-user">   
        <svg class="icon-home" aria-hidden="true">
          <use xlink:href="#icon-home"></use>
        </svg>
        {{username}}
      </div>
  </div>
</template>

<script>
  // import bus from '../../assets/js/bus.js'
	export default{
		name:'HeaderTitle',
		data(){
    	   return{
              isshow:false
            }
	    },
        computed:{
            username(){
                let username = localStorage.getItem('username');
                return username ? username : this.name;
            }
        },
        methods:{
            
        }
	}
</script>

<style>
  /* 头部导航 */
  .header-container{
    width: 100%;
    min-height: 50px;
    position: absolute;
    z-index: 99;
    top:3%;
  }
  .header-title{
    margin-left: 20px;
    min-width: 18%;
    /* background: rgba(22,65,112,0.5); */
    /* 渐变透明 */
    background-image: -webkit-linear-gradient(right,rgba(22,65,112,0.2) 0%, rgba(22,65,112,0.9) 100%);
    background-image: -moz-linear-gradient(right,rgba(22,65,112,0.2) 0%, rgba(22,65,112,0.9) 100%);
    background-image: -o-linear-gradient(right, rgba(22,65,112,0.2) 0%, rgba(22,65,112,0.9) 100%);
    background-image: linear-gradient(right, rgba(22,65,112,0.2) 0%,rgba(22,65,112,0.9) 100%);
    line-height: 35px;
    position: absolute;
    padding-left: 80px;
    top:15px;
    border:0.2px solid rgba(68,200,223,0.7);
    border-right:0;
    -webkit-animation-name:shineBlue;
    -webkit-animation-duration:3s;
    -webkit-animation-iteration-count:infinite;
    color: #fff;
    font-weight: bold;
    letter-spacing: 2px;
    cursor: pointer;
  }
  .header-user{
    position: absolute;
    right: 30px;
    min-width: 6%;
    /* background: rgba(22,65,112,0.5); */
    /* 渐变透明 */
    background-image: -webkit-linear-gradient(right,rgba(22,65,112,0.2) 0%, rgba(22,65,112,0.9) 100%);
    background-image: -moz-linear-gradient(right,rgba(22,65,112,0.2) 0%, rgba(22,65,112,0.9) 100%);
    background-image: -o-linear-gradient(right, rgba(22,65,112,0.2) 0%, rgba(22,65,112,0.9) 100%);
    background-image: linear-gradient(right, rgba(22,65,112,0.2) 0%,rgba(22,65,112,0.9) 100%);
    line-height: 35px;
    padding-left: 40px;
    top:15px;
    border:0.2px solid rgba(68,200,223,0.7);
    border-left: 0;
    -webkit-animation-name:shineBlue;
    -webkit-animation-duration:3s;
    -webkit-animation-iteration-count:infinite;
    color: #fff;
    font-weight: 5px;
    letter-spacing: 2px;
    cursor: pointer;

  }
  .icon-bulit {
     width: 4em;
     height: 4em;
     vertical-align: -0.15em;
     fill: currentColor;
     overflow: hidden;
     color: rgba(64,192,219,0.9);
     position: absolute;
     left: 40px;
     z-index: 111;
  }
  .icon-right{
     width: 1.5em;
     height: 1.5em;
     vertical-align: -0.15em;
     fill: currentColor;
     overflow: hidden;
     color: rgba(255,255,255,0.9);
     position: absolute;
     left: 25px;
     z-index: 111;
     top:20px;
  }
  .icon-home{
       width: 1.5em;
     height: 1.5em;
     vertical-align: -0.15em;
     fill: currentColor;
     overflow: hidden;
     color:rgba(64,192,219,0.8);
     position: absolute;
     right: 70%;
     z-index: 111;
     top:5px;
     cursor: pointer;
  }
</style>