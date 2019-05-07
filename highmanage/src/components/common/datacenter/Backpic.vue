<!--
  describe："3D动态背景图"
  created by：Jiang Duosheng
-->
<template>
	<div class="flex-box">
      <div class="box-radius1">
        <div class="box-radius2">
          <div class="box-radius3">
            <!-- 立体方块 -->
            <div class="cube">
                <div class="cube-face cube-face-front"></div>
                <div class="cube-face cube-face-back"></div>
                <div class="cube-face cube-face-top"></div>
                <div class="cube-face cube-face-bottom"></div>
            </div>
            <div class="cube">
                <div class="cube-face cube-face-front"></div>
                <div class="cube-face cube-face-left"></div>
                <div class="cube-face cube-face-back"></div>
                <div class="cube-face cube-face-right"></div>
                <div class="cube-face cube-face-top"></div>
                <div class="cube-face cube-face-bottom"></div>
            </div>
            <div class="cube">
                <div class="cube-face cube-face-front"></div>
                <div class="cube-face cube-face-back"></div>
                <div class="cube-face cube-face-top"></div>
                <div class="cube-face cube-face-bottom"></div>
            </div>
            <div class="cube">
                <div class="cube-face cube-face-front"></div>
                <div class="cube-face cube-face-back"></div>
                <div class="cube-face cube-face-top"></div>
                <div class="cube-face cube-face-bottom"></div>
            </div>
             <div class="cube">
                <div class="cube-face cube-face-front"></div>
                <div class="cube-face cube-face-back"></div>
                <div class="cube-face cube-face-top"></div>
                <div class="cube-face cube-face-bottom"></div>
            </div>
            <div class="cube">
                <div class="cube-face cube-face-front"></div>
                <div class="cube-face cube-face-left"></div>
                <div class="cube-face cube-face-back"></div>
                <div class="cube-face cube-face-right"></div>
                <div class="cube-face cube-face-top"></div>
                <div class="cube-face cube-face-bottom"></div>
            </div>
            <div class="cube">
                <div class="cube-face cube-face-front"></div>
                <div class="cube-face cube-face-left"></div>
                <div class="cube-face cube-face-back"></div>
                <div class="cube-face cube-face-right"></div>
                <div class="cube-face cube-face-top"></div>
                <div class="cube-face cube-face-bottom"></div>
            </div>
            <div class="cube">
                <div class="cube-face cube-face-front"></div>
                <div class="cube-face cube-face-left"></div>
                <div class="cube-face cube-face-back"></div>
                <div class="cube-face cube-face-right"></div>
                <div class="cube-face cube-face-top"></div>
                <div class="cube-face cube-face-bottom"></div>
            </div>
                <div class="cube">
                <div class="cube-face cube-face-front"></div>
                <div class="cube-face cube-face-left"></div>
                <div class="cube-face cube-face-back"></div>
                <div class="cube-face cube-face-right"></div>
                <div class="cube-face cube-face-top"></div>
                <div class="cube-face cube-face-bottom"></div>
            </div>

            <!-- 冒泡方块 -->
                <ul class="bg-bubbles">
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>

            <!-- 发散光圈 -->
              <div class="shan1"></div>

          </div>
        </div>
      </div>

      <!-- 上部光圈 -->
      <div class="box-radius4">
        <div class="box-radius5">
          <div class="box-radius6">
            <div class="box-radius7"><div class="shan"></div></div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
	export default{
	    name:"Backpic",
	    data(){
	      return{}
	    },
	    mounted(){

	    },

	  }
</script>

<style>
	.flex-box{
  display: flex;
  justify-content: center;
  align-items: flex-end;
  width: 100%;
  height: 100%;
  /* min-height: 730px; */
  }
  .box-radius1{
    -webkit-animation-name:shineBlue;
    -webkit-animation-duration:2s;
    -webkit-animation-iteration-count:infinite;
    border:1px #1E7FDB solid;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 85%;
    height: 200px;
    border-radius: 50%;
  }
  .box-radius2{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 75%;
    height: 150px;
    border:0.5px #96999A solid;
    border-radius: 50%;
    box-shadow:0px -100px 200px rgba(30,127,219,0.5);
  }
  .box-radius3{
    -webkit-animation-name:shineBlue;
    -webkit-animation-duration:2s;
    -webkit-animation-iteration-count:infinite;
    width: 90%;
    height: 130px;
    border:1.5px #1E7FDB solid;
    border-radius: 50%;
    background: rgba(30,127,219,0.1);
  }

  /* 立体特效 */
  .cube{
    width: 50px;
    height: 50px;
    position: relative;
    margin-left: -75px;
    
    -webkit-transform-style: preserve-3d;
    -webkit-transform: rotateY(50deg) translateZ(-200px);
    
  /*   -webkit-animation-name: rotationMainContainer;
    -webkit-animation-duration: 5s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-play-state: running; */
  }

  .cube:nth-of-type(1){
    top: 50px;
    left: 30%;
  }

  .cube:nth-of-type(2){
    top: 10px;
    left: 40%;
  }

  .cube:nth-of-type(3){
    top: 10px;
    left: 50%;
    -webkit-transform: rotateY(-30deg) translateZ(-100px);
  }

  .cube:nth-of-type(4){
    top: -200px;
    left: 60%;
  }

  .cube:nth-of-type(5){
    top: -120px;
    left: 50%;
    -webkit-transform: rotateY(-60deg) translateZ(-100px);
  }

  .cube:nth-of-type(6){
    top: -250px;
    left: 70%;
    -webkit-transform: rotateY(-60deg) translateZ(-100px);
  }

  .cube:nth-of-type(7){
    top: -250px;
    left: 70%;
    -webkit-transform: rotateY(-50deg) translateZ(-100px);
  }
  .cube:nth-of-type(8){
    top: -350px;
    left: 80%;
    -webkit-transform: rotateY(-40deg) translateZ(-100px);
  }
  .cube:nth-of-type(9){
    top: -350px;
    left: 80%;
    -webkit-transform: rotateY(-50deg) translateZ(-100px);
  }


  .cube:nth-of-type(1) .cube-face{
    width: 100px;
    height: 50px;
  }

  .cube:nth-of-type(3) .cube-face{
    width: 90px;
    height: 20px;
  }
  .cube:nth-of-type(4) .cube-face{
    width: 120px;
    height: 120px;
  }
  .cube:nth-of-type(5) .cube-face{
    width: 90px;
    height: 20px;
  }


  .cube:nth-of-type(3) .cube-face-front{
    -webkit-transform: translateZ(10px);
   /*  -webkit-animation-name: bgCAFace; */
  }

  .cube:nth-of-type(3) .cube-face-back{
    -webkit-transform: translateZ(-10px);
    /* -webkit-animation-name: bgCABack; */
  }

  .cube:nth-of-type(3) .cube-face-top{
    -webkit-transform: rotateX(90deg) translateZ(-10px);
    /* -webkit-animation-name: bgCATopBottom; */
  }

  .cube:nth-of-type(3) .cube-face-bottom{
    -webkit-transform: rotateX(90deg) translateZ(10px);
    /* -webkit-animation-name: bgCATopBottom; */
  }


  .cube:nth-of-type(4) .cube-face-front{
    -webkit-transform: translateZ(60px);
   /*  -webkit-animation-name: bgCAFace; */
  }

  .cube:nth-of-type(4) .cube-face-back{
    -webkit-transform: translateZ(-60px);
    /* -webkit-animation-name: bgCABack; */
  }

  .cube:nth-of-type(4) .cube-face-top{
    -webkit-transform: rotateX(90deg) translateZ(-60px);
    /* -webkit-animation-name: bgCATopBottom; */
  }

  .cube:nth-of-type(4) .cube-face-bottom{
    -webkit-transform: rotateX(90deg) translateZ(60px);
    /* -webkit-animation-name: bgCATopBottom; */
  }

  .cube:nth-of-type(5) .cube-face-front{
    -webkit-transform: translateZ(10px);
   /*  -webkit-animation-name: bgCAFace; */
  }

  .cube:nth-of-type(5) .cube-face-back{
    -webkit-transform: translateZ(-10px);
    /* -webkit-animation-name: bgCABack; */
  }

  .cube:nth-of-type(5) .cube-face-top{
    -webkit-transform: rotateX(90deg) translateZ(-10px);
    /* -webkit-animation-name: bgCATopBottom; */
  }

  .cube:nth-of-type(5) .cube-face-bottom{
    -webkit-transform: rotateX(90deg) translateZ(10px);
    /* -webkit-animation-name: bgCATopBottom; */
  }

  .cube-face{
    width: 50px;
    height: 50px;
    position: absolute;
    background: rgba(154,215,245,0.1);
    border: 1.5px #0382B6 solid;
    -webkit-transform-origin: 50% 50%;
    -webkit-animation-duration: 8s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-play-state: running;
    -webkit-animation-name:shineBlue;
  }

  .cube-face-front{
    -webkit-transform: translateZ(25px);
   /*  -webkit-animation-name: bgCAFace; */
  }

  .cube-face-left{
    -webkit-transform: rotateY(90deg) translateZ(25px);
    /* -webkit-animation-name: bgCALeft; */
  }

  .cube-face-back{
    -webkit-transform: translateZ(-25px);
    /* -webkit-animation-name: bgCABack; */
  }

  .cube-face-right{
    -webkit-transform: rotateY(90deg) translateZ(-25px);
    /* -webkit-animation-name: bgCARight; */
  }

  .cube-face-top{
    -webkit-transform: rotateX(90deg) translateZ(-25px);
    /* -webkit-animation-name: bgCATopBottom; */
  }

  .cube-face-bottom{
    -webkit-transform: rotateX(90deg) translateZ(25px);
    /* -webkit-animation-name: bgCATopBottom; */
  }

  /* 浮动方块 */
  .bg-bubbles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1;
  }
  ul,li {
      margin: 0;
      padding: 0;
  }
  .bg-bubbles li {
      position: absolute;
      list-style: none;
      display: block;
      width: 40px;
      height: 40px;
      background-color: rgba(154,215,245,0.4);
      bottom: -160px;
      -webkit-animation: square 25s infinite;
      animation: square 25s infinite;
      -webkit-transition-timing-function: linear;
      transition-timing-function: linear;
  }
  .bg-bubbles li:nth-child(1) {
    left: 10%
  }

  .bg-bubbles li:nth-child(2) {
    left: 20%;
    width: 80px;
    height: 80px;
    -webkit-animation-delay: 200ms;
    animation-delay: 200ms;
    -webkit-animation-duration: 17s;
    animation-duration: 17s
  }

  .bg-bubbles li:nth-child(3) {
    left: 25%;
    -webkit-animation-delay: 400ms;
    animation-delay: 400ms
  }

  .bg-bubbles li:nth-child(4) {
    left: 40%;
    width: 60px;
    height: 60px;
    -webkit-animation-duration: 10s;
    animation-duration: 10s;
    background-color: rgba(255, 255, 255, .25)
  }

  .bg-bubbles li:nth-child(5) {
    left: 70%
  }

  .bg-bubbles li:nth-child(6) {
    left: 80%;
    width: 120px;
    height: 120px;
    -webkit-animation-delay: 3s;
    animation-delay: 3s;
    background-color: rgba(255, 255, 255, .2)
  }

  .bg-bubbles li:nth-child(7) {
    left: 32%;
    width: 100px;
    height: 100px;
    -webkit-animation-delay: 7s;
    animation-delay: 7s
  }

  .bg-bubbles li:nth-child(8) {
    left: 55%;
    width: 20px;
    height: 20px;
    -webkit-animation-delay: 15s;
    animation-delay: 15s;
    -webkit-animation-duration: 20s;
    animation-duration: 20s
  }

  .bg-bubbles li:nth-child(9) {
    left: 25%;
    width: 10px;
    height: 10px;
    -webkit-animation-delay: 2s;
    animation-delay: 2s;
    -webkit-animation-duration: 20s;
    animation-duration: 20s;
    background-color: rgba(255, 255, 255, .3)
  }

  .bg-bubbles li:nth-child(10) {
    left: 90%;
    width: 20px;
    height: 20px;
    -webkit-animation-delay: 11s;
    animation-delay: 11s
  }

  @-webkit-keyframes square {
    0% {
      -webkit-transform: translateY(0);
      transform: translateY(0)
    }

    100% {
      -webkit-transform: translateY(-700px) rotate(600deg);
      transform: translateY(-700px) rotate(600deg)
    }

  }

  @keyframes square {
    0% {
      -webkit-transform: translateY(0);
      transform: translateY(0)
    }

    100% {
      -webkit-transform: translateY(-700px) rotate(600deg);
      transform: translateY(-700px) rotate(600deg)
    }

  } 

  /* 圆圈扩散 */
  .shan {
      /* position: absolute; */
      top: 0px;
      left: 0px;
      right:0px;
      bottom: 0px;
      margin: auto;
      background: rgba(33,115,189,0.8);
      width: 95%; 
      height: 120px;
      border-radius: 50%;
      animation: show-animation 2s ease-in-out 0s infinite;
      -moz-animation: show-animation 2s ease-in-out 0s infinite;
      -webkit-animation: show-animation 2s ease-in-out 0s infinite;
  }

   /* 圆圈扩散 */
  .shan1 {
      position: absolute;
      top: 500px;
      left: 0px;
      right:0px;
      bottom: 0px;
      margin: auto;
      background: rgba(33,115,189,0.8);
      width: 95%; 
      height: 120px;
      border-radius: 50%;
      animation: show-animation 2s ease-in-out 0s infinite;
      -moz-animation: show-animation 2s ease-in-out 0s infinite;
      -webkit-animation: show-animation 2s ease-in-out 0s infinite;
  }


  @keyframes show-animation{
      0%{
          transform: scale(0);
          -moz-transform: scale(0);
          -webkit-transform: scale(0);
      }
      100%{
          transform: scale(1);
          -moz-transform: scale(1);
          -webkit-transform: scale(1);
          opacity: 0;
      }
  }

  /* 上部圆圈 */
  .box-radius4{
    align-self: flex-start;
    margin-left: -85%;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 85%;
    height: 200px;
  }
  .box-radius5{
    -webkit-animation-name:shineBlue;
    -webkit-animation-duration:2s;
    -webkit-animation-iteration-count:infinite;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 70%;
    height: 120px;
    border:1.5px #1E7FDB solid;
    border-radius: 50%;
    
  }
  .box-radius6{
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow:0px 100px 200px rgba(138,214,246,0.8);
    width:85%;
    height: 100px;
    border:0.5px #96999A solid;
    border-radius: 50%;
    background: rgba(30,127,219,0.1);
    
  }
  .box-radius7{
     -webkit-animation-name:shineBlue;
    -webkit-animation-duration:2s;
    -webkit-animation-iteration-count:infinite;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 85%;
    height: 70px;
    border:1.5px #1E7FDB solid;
    border-radius: 50%;
    background: rgba(30,127,219,0.1);
  }

  .box-radius7 .shan{
    height: 70px;
  }
</style>