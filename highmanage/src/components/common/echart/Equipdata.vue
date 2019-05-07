<template>
        <div id="main4" class="chartAll">
        </div>
</template>

<script>
    import echarts from 'echarts'
    export default{
        name:'Equipdata',
        data(){
            return{
                keshi:'',
                changdi:'',
                qicai:'',
                jingfei:'',
                shebei:''
            }
        },
        mounted() {
            this.getEquip();
        },
        methods:{
            getEquip(){
                 this.$axios.get('http://www.clubs.org/index.php/getAllEquip')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let Keshi = [];
                        let Changdi = [];
                        let Qicai = [];
                        let Jingfei = [];
                        let Shebei = [];
                        ret.data.forEach((val)=>{
                            if(val.ispass==1){
                                if(val.e_nature=="经费"){
                                    Jingfei.push(val);
                                }
                                if(val.e_nature=="设备"){
                                    Shebei.push(val);
                                }
                                if(val.e_nature=="场地"){
                                    Changdi.push(val);
                                }
                                if(val.e_nature == "器材"){
                                    Qicai.push(val);
                                }
                                if(val.e_nature == "课室"){
                                    Keshi.push(val);
                                }
                            }  
                        });
                        this.keshi=Keshi.length;
                        this.jingfei=Jingfei.length;
                        this.qicai=Qicai.length;
                        this.shebei=Shebei.length;
                        this.changdi=Changdi.length;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                .then(()=>{
                    this.DrawEquipChart();
                })
            },
            DrawEquipChart(){
                var myChart = echarts.init(document.getElementById('main4'));
                var ydata = [{
                        name: '课室',
                        value: this.keshi
                    },
                    {
                        name: '场地',
                        value: this.changdi
                    },
                    {
                        name: '器材',
                        value: this.qicai
                    },
                    {
                        name: '经费',
                        value: this.jingfei
                    },
                    {
                        name: '设备',
                        value: this.shebei
                    }
                ];
                var color =["#BC8DEE", "#8693F3","#89C3F8","#F2A695","#FCC667","#AEB7F9","#748BFA"];
                var xdata = ['课室', "场地", "器材", "经费", '设备'];
                var option = {
                     // backgroundColor: "rgba(255,255,255,0.5)",
                    title:{
                        text:'社团申请类型比例',                     
                        left:'center',
                        textStyle:{
                            color:'#fff',
                            fontFamily:'monospace'
                        },
                    },
                    color:color,
                    legend: {
                        orient: "vartical",
                        x: "left",
                        top: "40%",
                        left: "80%",
                        bottom: "0%",
                        data: xdata,
                        itemWidth: 20,
                        itemHeight: 14,
                        itemGap :15,
                        textStyle:{
                            color:'#fff'
                        },
                        formatter :function(name){
                            return '   '+name
                          }
                    },
                    series: [{
                        name: '违规次数',
                        type: 'pie',
                        clockwise: false, //饼图的扇区是否是顺时针排布
                        minAngle: 20, //最小的扇区角度（0 ~ 360）
                        radius: ["30%", "58%"],
                        center: ["35%", "50%"],
                        avoidLabelOverlap: false,
                         itemStyle: { //图形样式
                            normal: {
                                borderColor: '#ffffff',
                                borderWidth: 10,
                            },
                        },
                        label: {
                            normal: {
                                show: false,
                                position: 'center',
                                formatter: '{text|{b}}\n{value|{d}%}',
                                rich: {
                                    text: {
                                        color: "#fff",
                                        fontSize: 14,
                                        align: 'center',
                                        verticalAlign: 'middle',
                                        padding: 5
                                    },
                                    value: {
                                        color: "#F9D019",
                                        fontSize: 24,
                                        align: 'center',
                                        verticalAlign: 'middle',
                                    },
                                }
                            },
                            emphasis: {
                                show: true,
                                textStyle: {
                                    fontSize: 46,
                                }
                            }
                        },
                        data: ydata
                    }]
                };

                myChart.setOption(option);

                setTimeout(function() {
                    myChart.dispatchAction({
                        type: 'highlight',
                        seriesIndex: 0,
                        dataIndex: 0
                    });

                    myChart.on('mouseover', function(params) {
                        if (params.name == ydata[0].name) {
                            myChart.dispatchAction({
                                type: 'highlight',
                                seriesIndex: 0,
                                dataIndex: 0
                            });
                        } else {
                            myChart.dispatchAction({
                                type: 'downplay',
                                seriesIndex: 0,
                                dataIndex: 0
                            });
                        }
                    });

                    myChart.on('mouseout', function(params) {
                        myChart.dispatchAction({
                            type: 'highlight',
                            seriesIndex: 0,
                            dataIndex: 0
                        });
                    });
                }, 1000);

            },

        }
    }
</script>

<style scoped>
    #main4>div{
        width: 100% !important;
    }
    #main4{
        width: 100%;
        height: 100%;
    }
    #main4>div>canvas{
        cursor: pointer;
        width: 100% !important;
    }
</style>