<template>
    <div id="main1" class="chartAll"></div>
</template>

<script>
    import echarts from 'echarts'
    export default{
        name:'Regtrend',
        data(){
            return{
                one:'',
                two:'',
                three:'',
                four:'',
                five:'',
                six:'',
                seven:'',
                eight:'',
                night:'',
                ten:'',
                elev:'',
                twel:''
            }
        },
        mounted() {
            this.getMember();
        },
        methods:{
            getMember(){
                this.$axios.get('http://www.clubs.org/index.php/getAllMember')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let One =[];
                        let Two=[];
                        let Three=[];
                        let Four=[];
                        let Five=[];
                        let Six=[];
                        let Seven=[];
                        let Eight=[];
                        let Night =[];
                        let Ten = [];
                        let Elev =[];
                        let Twel=[];
                        ret.data.forEach((val)=>{
                            if(this.common.getMon(val.create_time)==1){
                                One.push(val);
                            }
                            if(this.common.getMon(val.create_time)==2){
                                Two.push(val);
                            }
                            if(this.common.getMon(val.create_time)==3){
                                Three.push(val);
                            }
                            if(this.common.getMon(val.create_time)==4){
                                Four.push(val);
                            }
                            if(this.common.getMon(val.create_time)==5){
                                Five.push(val);
                            }
                            if(this.common.getMon(val.create_time)==6){
                                Six.push(val);
                            }
                            if(this.common.getMon(val.create_time)==7){
                                Seven.push(val);
                            }
                            if(this.common.getMon(val.create_time)==8){
                                Eight.push(val);
                            }
                            if(this.common.getMon(val.create_time)==9){
                                Night.push(val);
                            }
                            if(this.common.getMon(val.create_time)==10){
                                Ten.push(val);
                            }
                            if(this.common.getMon(val.create_time)==11){
                                Elev.push(val);
                            }
                            if(this.common.getMon(val.create_time)==12){
                                Twel.push(val);
                            }
                        });
                        this.one=One.length;
                        this.two=Two.length;
                        this.three=Three.length;
                        this.four=Four.length;
                        this.five=Five.length;
                        this.six=Six.length;
                        this.seven=Seven.length;
                        this.eight=Eight.length;
                        this.night=Night.length;
                        this.ten=Ten.length;
                        this.elev=Elev.length;
                        this.twel=Twel.length;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                .then(()=>{
                    this.DrawHistogram();
                });
            },

            DrawHistogram(){
              var myChart1 = echarts.init(document.getElementById('main1'));
              var option1 = {
                // backgroundColor: "rgba(5,34,77,0.6)",
                tooltip: {},
                title:{
                  text:'会员注册趋势',
                  textStyle:{
                    color:'#fff',
                    fontSize:14,
                    fontWeight:10,
                    align:'left',
                  },
                  left:10,
                },
                grid: {
                    top: '15%',
                    left: '1%',
                    right: '1%',
                    bottom: '5%',
                    containLabel: true,
                    width:'92%',
                },
                legend: {
                    itemGap: 50,
                    data: ['注册总量' ,'最新注册量'],
                    textStyle: {
                        color: '#f9f9f9',
                        borderColor: '#fff'
                    },
                },
                xAxis: [{
                    type: 'category',
                    boundaryGap: true,
                    axisLine: { //坐标轴轴线相关设置。数学上的x轴
                        show: true,
                        lineStyle: {
                            color: '#f9f9f9',
                        },
                    },
                    axisLabel: { //坐标轴刻度标签的相关设置
                        textStyle: {
                            color: '#d1e6eb',
                            margin: 15,
                        },
                    },
                    axisTick: {
                        show: false,
                    },
                    data: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月', ],
                }],
                yAxis: [{
                    type: 'value',
                    min: 0,
                    // max: 140,
                    splitNumber: 5,
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#0a3256'
                        }
                    },
                    axisLine: {
                        show: false,
                    },
                    axisLabel: {
                        margin: 20,
                        textStyle: {
                            color: '#d1e6eb',

                        },
                    },
                    axisTick: {
                        show: false,
                    },
                }],
              series: [{
                name: '注册总量',
                type: 'line',
                showAllSymbol: true,
                symbol: 'emptyCircle',
                symbolSize: 6,
                lineStyle: {
                    normal: {
                      color: "#28ffb3", // 线条颜色
                    },
                    borderColor: '#f0f'
                },
                label: {
                    show: true,
                    position: 'top',
                    textStyle: {
                        color: '#fff',
                    }
                },
                itemStyle: {
                    normal: {
                        color: "#28ffb3",
                    }
                },
                tooltip: {
                    show: false
                  },
                areaStyle: { //区域填充样式
                  normal: {
                        //线性渐变，前4个参数分别是x0,y0,x2,y2(范围0~1);相当于图形包围盒中的百分比。如果最后一个参数是‘true’，则该四个值是绝对像素位置。
                        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                          {
                            offset: 0,
                            color: 'rgba(0,154,120,1)'
                          },
                          {
                                offset: 1,
                                color: 'rgba(0,0,0, 0)'
                          }
                        ], false),
                        shadowColor: 'rgba(53,142,215, 0.9)', //阴影颜色
                        shadowBlur: 20 //shadowBlur设图形阴影的模糊大小。配合shadowColor,shadowOffsetX/Y, 设置图形的阴影效果。
                    }
                },

                data: [30, 45, 48, 90, 150, 132, 178,125,23,56,77,200]
                }, {
                name: '最新注册量',
                type: 'bar',
                barWidth: 20,
                tooltip: {
                  show: false
                },
                label: {
                    show: true,
                    position: 'top',
                    textStyle: {
                        color: '#fff',
                    }
                },
                itemStyle: {
                  normal: {
                      color: function(params) {
                          var colorList = ['#0ec1ff', '#10cdff', '#12daff', '#15ebff', '#17f8ff', '#1cfffb', '#1dfff1'];
                          return colorList[params.dataIndex];
                      }
                  }
                },
                data: [this.one, this.two, this.three, this.four, this.five, this.six, this.seven,this.eight,this.night,this.ten,this.elev,this.twel]
                }]
              };
              myChart1.setOption(option1);
            },
        }
    }
</script>

<style scoped>
    #main1>div{
        width: 100% !important;
    }
    #main1{
        width: 100%;
        height: 100%;
    }
    #main1>div>canvas{
        cursor: pointer;
        width: 100% !important;
    }
</style>