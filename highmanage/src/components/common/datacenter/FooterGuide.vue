<!--
  describe："科技感底部按钮"
  created by：Jiang Duosheng
-->
<template>
	<div class="footer-container">
      <div class="footer-radius">  
        <svg class="icon-home" aria-hidden="true">
          <use xlink:href="#icon-home"></use>
        </svg>
      </div>
    </div>
</template>

<script>
	export default{
		name:'FooterGuide',
		data(){
			return{}
		},
	}
</script>

<style>
	/* 底部导航 */
	.footer-container{
		cursor: pointer;
		position: absolute;
		bottom: 0;
		display: flex;
		justify-content: center;
		align-items: flex-end;
		width: 12%;
		height: 90px;
		z-index: 99;
		background: rgba(15,76,121,0.6);
		left: 50%;
		transform: translate(-50%,0);
		border-radius: 180px 180px 0 0;
		border:0.5px solid rgba(68,200,223,0.7);
		box-shadow:0 0 20px #1E7FDB;
		-webkit-box-shadow:0 0 20px #1E7FDB;
		/* visibility: hidden; */
	}
	.footer-radius{
		display: flex;
		justify-content: center;
		align-items: flex-end;
		width: 70%;
		height: 70%;
		background: rgba(18,45,72,0.8);
		border-radius: 160px 160px 0 0;
		border:2px solid rgba(0,0,0,0.7);;
		box-shadow:0 0 30px #3DAFD4 inset,0 0 30px #3DAFD4;
		-webkit-box-shadow:0 0 30px #3DAFD4 inset,0 0 30px #3DAFD4;
		border-bottom: 0;

	}

	.footer-container .footer-radius .icon-home{
		 width: 2.5em;
		 height: 2.5em;
		 position: absolute;
		 left: 50%;
		 transform: translate(-50%,0);
	}
</style>