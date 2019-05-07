<!--
  describe："科技感轮播动画"
  created by：Jiang Duosheng
-->
<template>
    <div class="htmleaf-container">
      <div class="carousel" data-gap="20">
        <figure>
          	<div class="padding-full">
          		<div class="bg-four">
          			<div class="bg-content">
            			<v-totalnum></v-totalnum>
		          	</div>
		        </div>
		    </div>

          	<div class="padding-full">
          		<div class="bg-four">
          			<div class="bg-content">
            			<v-clubdata></v-clubdata>
		          	</div>
		        </div>
		    </div>

          	<div class="padding-full">
          		<div class="bg-four">
          			<div class="bg-content">
          				<v-regtrend></v-regtrend>
          			</div>
          		</div>
          	</div>

          	<div class="padding-full">
          		<div class="bg-four">
          			<div class="bg-content">
          				<v-leida></v-leida>
          			</div>
          		</div>
          	</div>

          	<div class="padding-full">
          		<div class="bg-four">
          			<div class="bg-content">
						<v-equipdata></v-equipdata>
		          	</div>
		        </div>
		    </div>

          	<div class="padding-full">
          		<div class="bg-four">
          			<div class="bg-content">
          				<v-commentdata></v-commentdata>
          			</div>
          		</div>
          	</div>

          	<div class="padding-full">
          		<div class="bg-four">
          			<div class="bg-content">
            			<v-actiondata></v-actiondata>
		          	</div>
		        </div>
		    </div>

          	<div class="padding-full">
          		<div class="bg-four">
          			<div class="bg-content">
          				<v-sexdata></v-sexdata>
          			</div>
          		</div>
          	</div>
        </figure>
        <nav>
          <button class="nav prev "><<</button>
          <button class="nav next ">>></button>
        </nav>
      </div>
    </div>
</template>

<script>
	import vTotalnum from '../echart/Totalnum.vue'
	import vClubdata from '../echart/Clubdata.vue'
	import vRegtrend from '../echart/Regtrend.vue'
	import vSexdata from '../echart/Sexdata.vue'
	import vActiondata from '../echart/Actiondata.vue'
	import vEquipdata from '../echart/Equipdata.vue'
	import vCommentdata from '../echart/Commentdata.vue'
	import vLeida from '../echart/Leida.vue'
	
	export default {
		name:'Slideshow',
		components:{
			vTotalnum,
			vClubdata,
			vRegtrend,
			vSexdata,
			vActiondata,
			vEquipdata,
			vCommentdata,
			vLeida
		},
		data() {
			return{}
		},
		mounted() {
			this.Runcarouse();
		},
	    methods:{
	    	//轮播
			Runcarouse(){
				var carousels = document.querySelectorAll('.carousel');
				for (var i = 0; i < carousels.length; i++) {
					this.carousel(carousels[i]);
				}
			},
			carousel(root) {
				var figure = root.querySelector('figure'),
				nav = root.querySelector('nav'),
				images = figure.children,
				n = images.length,
				gap = root.dataset.gap || 0,
				bfc = 'bfc' in root.dataset,
				theta = 2 * Math.PI / n,
				currImage = 0;
				setupCarousel(n, parseFloat(getComputedStyle(images[0]).width));
				window.addEventListener('resize', function () {
					setupCarousel(n, parseFloat(getComputedStyle(images[0]).width));
				});

				setupNavigation();

				function setupCarousel(n, s) {
					var apothem = s / (2 * Math.tan(Math.PI / n));

					figure.style.transformOrigin = '50% 50% ' + -apothem + 'px';

					for (var i = 0; i < n; i++) {
						images[i].style.padding = gap + 'px';
					}for (i = 1; i < n; i++) {
						images[i].style.transformOrigin = '50% 50% ' + -apothem + 'px';
						images[i].style.transform = 'rotateY(' + i * theta + 'rad)';
					}
					if (bfc) for (i = 0; i < n; i++) {
						images[i].style.backfaceVisibility = 'hidden';
					}rotateCarousel(currImage);
				}

				function setupNavigation() {
					nav.addEventListener('click', onClick, true);

					function onClick(e) {
						e.stopPropagation();

						var t = e.target;
						if (t.tagName.toUpperCase() != 'BUTTON') return;

						if (t.classList.contains('next')) {
							currImage++;
						} else {
							currImage--;
						}

						rotateCarousel(currImage);
					}
				}

				function rotateCarousel(imageIndex) {
					figure.style.transform = 'rotateY(' + imageIndex * -theta + 'rad)';
				}
			}

		}
	}
</script>

<style scoped>
	/* 轮播图 */
	.htmleaf-container{
		width: 100%;
		margin: 0 auto;
		position: absolute;
		z-index: 99;
		top: 50%;
		left: 50%;
		transform: translate(-50%,-50%);
	}
	.carousel {
	  -webkit-perspective: 500px;
	          perspective: 500px;
	  overflow: hidden;
	  display: -webkit-box;
	  display: -ms-flexbox;
	  display: flex;
	  -webkit-box-orient: vertical;
	  -webkit-box-direction: normal;
	      -ms-flex-direction: column;
	          flex-direction: column;
	  -webkit-box-align: center;
	      -ms-flex-align: center;
	          align-items: center;
	   padding-bottom: 60px;
	}
	.carousel > * {
	  -webkit-box-flex: 0;
	      -ms-flex: 0 0 auto;
	          flex: 0 0 auto;
	}
	.carousel figure {
	  margin: 0;
	  width: 50%;
	  -webkit-transform-style: preserve-3d;
	          transform-style: preserve-3d;
	  -webkit-transition: -webkit-transform 0.5s;
	  transition: -webkit-transform 0.5s;
	  transition: transform 0.5s;
	  transition: transform 0.5s, -webkit-transform 0.5s;
	}

	.carousel nav {
		position: absolute;
		left: 50%;
		top: 50%;
		z-index: -100;
		transform: translate(-50%,-50%);
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		    -ms-flex-pack: center;
		        justify-content: center;
		width: 100%;
	}
	.carousel nav button{
	  -webkit-box-flex: 0;
	      -ms-flex: 0 0 auto;
	          flex: 0 0 auto;
	  cursor: pointer;
	  color: rgba(30, 95, 151, 0.8);
	  -webkit-text-stroke: 2px rgba(64,192,219,0.5);
	  text-stroke: 2px rgba(64,192,219,0.5);
	  font-weight: bold;
	  background: none;
	  border:none;
	  outline:0 none !important;
	  -webkit-animation-name:bigger;
	  -webkit-animation-duration:1.5s;
	  -webkit-animation-iteration-count:infinite;
	}

	@keyframes bigger{
		from{font-size: 50px; color: rgba(30, 95, 151, 0.2);-webkit-text-stroke:1px rgba(64,192,219,0.3);}	
		/* 90%{font-size:60px;} */
		to{font-size: 65px; }
	}

	.carousel nav button:hover{
	  color: rgba(64,192,219,0.5);
	  font-size: 70px;
	}

	.carousel nav button:nth-of-type(1) {
	  margin: 0 38% 0 5%;
	}
	.carousel nav button:nth-of-type(2) {
	  margin: 0 5% 0 38%;
	}
	.bg-content{
		width: 100%;
		height: 100%;
		background: rgba(30,127,219,0.2);
		-webkit-box-shadow:0 0 20px #1E7FDB;
		box-shadow:0 0 20px #1E7FDB;
		border:1px #1E7FDB solid;
	}
/* 	.chartAll>div{
		width: 100% !important;
	}
	.chartAll{
		width: 100%;
		height: 100%;
	}
	.chartAll>div>canvas{
		cursor: pointer;
	} */

	 /*四角*/
	 .carousel figure .bg-four{
	        background: linear-gradient(to left, #3EBED9, #3EBED9) left top no-repeat, 
	                linear-gradient(to bottom, #3EBED9, #3EBED9) left top no-repeat, 
	                linear-gradient(to left, #3EBED9, #3EBED9) right top no-repeat,
	                linear-gradient(to bottom, #3EBED9, #3EBED9) right top no-repeat, 
	                linear-gradient(to left, #3EBED9, #3EBED9) left bottom no-repeat,
	                linear-gradient(to bottom, #3EBED9, #3EBED9) left bottom no-repeat,
	                linear-gradient(to left, #3EBED9, #3EBED9) right bottom no-repeat,
	                linear-gradient(to left, #3EBED9, #3EBED9) right bottom no-repeat;
	    background-size: 3px 40px, 40px 3px, 3px 40px, 40px 3px; 
	    border-radius: 3px;
	      width: 100%;
		  height: 350px;
		  box-sizing: border-box;
		  padding:3px !important;
		   cursor: pointer;
	  }

	.carousel figure .bg-four:not(:first-of-type) {
	  position: absolute;
	  left: 0px;
	  top: 0;
	}

	.carousel figure .padding-full{
		width: 100%;
		height: 350px;
		box-sizing: border-box;
	}

	 .carousel figure .padding-full:not(:first-of-type) {
	  position: absolute;
	  left: 0px;
	  top: 0;
	}
</style>