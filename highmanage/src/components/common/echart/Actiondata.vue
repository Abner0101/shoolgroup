<template>
        <div id="main3" class="chartAll">
        </div>
</template>

<script>
    import echarts from 'echarts'
    export default{
        name:'Actiondata',
        data(){
            return{
                bisai:'',
                xinwen:'',
                zhaoxin:'',
                fuwu:'',
                kewai:'',
                biaoyan:'',
                huigu:'',
                shengming:'',
                huodong:'',
                wanhui:''
            }
        },
        mounted() {
            this.getAction();
        },
        methods:{
            getAction(){
                 this.$axios.get('http://www.clubs.org/index.php/getAllAction')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let Bisai = [];
                        let Xinwen = [];
                        let Zhaoxin = [];
                        let Fuwu = [];
                        let Kewai = [];
                        let Biaoyan = [];
                        let Huigu =[];
                        let Shengming = [];
                        let Huodong = [];
                        let Wanhui = [];
                        ret.data.forEach((val)=>{
                            if(val.ispass==1){
                                if(val.a_nature=="比赛"){
                                    Bisai.push(val);
                                }
                                if(val.a_nature=="新闻"){
                                    Xinwen.push(val);
                                }
                                if(val.a_nature=="招新"){
                                    Zhaoxin.push(val);
                                }
                                if(val.a_nature == "服务"){
                                    Fuwu.push(val);
                                }
                                if(val.a_nature == "课外"){
                                    Kewai.push(val);
                                }
                                if(val.a_nature == "表演"){
                                    Biaoyan.push(val);
                                }
                                if(val.a_nature == "回顾"){
                                    Huigu.push(val);
                                }
                                if(val.a_nature == "声明"){
                                    Shengming.push(val);
                                }
                                if(val.a_nature == "活动"){
                                    Huodong.push(val);
                                }
                                if(val.a_nature == "晚会"){
                                    Wanhui.push(val);
                                }
                            }  
                        });
                        this.bisai=Bisai.length;
                        this.xinwen=Xinwen.length;
                        this.zhaoxin=Zhaoxin.length;
                        this.fuwu=Fuwu.length;
                        this.kewai=Kewai.length;
                        this.biaoyan=Biaoyan.length;
                        this.huigu=Huigu.length;
                        this.shengming=Shengming.length;
                        this.huodong=Huodong.length;
                        this.wanhui=Wanhui.length;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                .then(()=>{
                    this.DrawActionChart();
                })
            },
            DrawActionChart(){
                var myChart2 = echarts.init(document.getElementById('main3'));
                var data = [{
                    "value": this.bisai,
                    "name": "比赛"
                }, {
                    "value": this.xinwen,
                    "name": "新闻"
                }, {
                    "value": this.zhaoxin,
                    "name": "招新"
                }, {
                    "value": this.fuwu,
                    "name": "服务"
                }, {
                    "value": this.kewai,
                    "name": "课外"
                }, {
                    "value": this.biaoyan,
                    "name": "表演"
                }, {
                    "value": this.huigu,
                    "name": "回顾"
                }, {
                    "value": this.shengming,
                    "name": "声明"
                }, {
                    "value": this.huodong,
                    "name": "活动"
                }, {
                    "value": this.wanhui,
                    "name": "晚会"
                }]
                var dataOne = data.filter(function(row) {
                    return !row.unfinished
                })
                var dataTwo = data.filter(function(row) {
                    return row.unfinished
                })

                var selectedObj = {}
                dataTwo.forEach(function(row) {
                    selectedObj[row.name] = false
                })
                var option = {
                    title:{
                        text:'公告类型分布',                     
                        left:'center',
                        textStyle:{
                          color:'#fff',
                          fontFamily:'monospace'
                        },
                    },
                    tooltip: {
                        trigger: 'item',
                        extraCssText:'width:200px !important;background:rgba(5,34,77,0.7)',
                    },
                    legend: [{
                        orient: 'vertical',
                        left: 0,
                        textStyle:{
                            color:'#fff'
                        },
                        data: dataOne.map(function(row) {
                            return row.name
                        })
                    }, {
                        orient: 'vertical',
                        right: 0,
                        selectedMode: false,
                        selected: selectedObj,
                        data: dataTwo.map(function(row) {
                            return row.name
                        })
                    }],
                    series: [{
                        name: '二类占比',
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '50%'],
                        data: data
                    }]
                };

                myChart2.setOption(option);
            },


        }
    }
</script>

<style scoped>
    #main3>div{
        width: 100% !important;
    }
    #main3{
        width: 100%;
        height: 100%;
    }
    #main3>div>canvas{
        cursor: pointer;
        width: 100% !important;
    }
</style>