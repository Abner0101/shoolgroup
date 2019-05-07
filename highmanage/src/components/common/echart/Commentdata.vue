<template>
        <div id="main6" class="chartAll">
        </div>
</template>

<script>
    import echarts from 'echarts'
    export default{
        name:'Commentdata',
        data(){
            return{
                huizhang:'',
                fuhui:'',
                chengyuan:'',
                ganshi:'',
                putong:'',
            }
        },
        mounted() {
            this.getTable();
            this.getMember();
        },
        methods:{
            getTable(){
                 this.$axios.get('http://www.clubs.org/index.php/getAllTable')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let Huizhang = [];
                        let Fuhui = [];
                        let Chengyuan = [];
                        let Ganshi = [];
                        ret.data.forEach((val)=>{
                            if(val.station==1){
                                if(val.role=="会长"){
                                    Huizhang.push(val);
                                }
                                if(val.role=="副会长"){
                                    Fuhui.push(val);
                                }
                                if(val.role=="社团干事"){
                                    Ganshi.push(val);
                                }
                                if(val.role == "普通会员"){
                                    Chengyuan.push(val);
                                }
                            }  
                        });
                        this.huizhang=Huizhang.length;
                        this.fuhui=Fuhui.length;
                        this.chengyuan=Chengyuan.length;
                        this.ganshi=Ganshi.length;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                // .then(()=>{
                //     this.getMember();
                // })
                .then(()=>{
                    this.DrawCommentChart();
                })
            },

            getMember(){
                this.$axios.get('http://www.clubs.org/index.php/getAllMember')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        // let temp =[];
                        // ret.data.forEach((val)=>{
                        //     val.create_time=this.common.toDate(val.create_time);
                        //     temp.push(val);
                        // });
                        // console.log(ret.data);
                        this.putong=ret.data.length;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                .then(()=>{
                    this.DrawCommentChart();
                })
            },
            
            DrawCommentChart(){
                var myChart = echarts.init(document.getElementById('main6'));
                var colorList = ['#f75757','#f9cb3f','#27c24c','#2cdafc','#23a2f5'];
                var option = {
                    title: {
                        text: '用户金字塔',
                        textStyle:{
                            color:'#fff',
                            fontFamily:'monospace'
                        },
                    },
                    tooltip: {
                        show:false,
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c}%",
                        
                    },
                    toolbox: {
                        feature: {
                            dataView: {readOnly: false},
                            restore: {},
                            saveAsImage: {}
                        }
                    },
                    legend: {
                        data: ['会长','副会长','干事','社团成员','普通会员'],
                        textStyle:{
                            color:'#fff'
                        }
                    },
                    calculable: true,
                    color:colorList,
                    series: [
                        {
                            name:'漏斗图',
                            type:'funnel',
                            left: '5%',
                            right:'35%',
                            top: '10%',
                            bottom: '10%',
                            minSize: '0%',
                            maxSize: '100%',
                            sort: 'ascending',
                            gap: 2,
                            label: {
                                show: true,
                                position: 'inside'
                            },
                            labelLine: {
                                length: 10,
                                lineStyle: {
                                    width: 1,
                                    type: 'solid'
                                }
                            },
                            itemStyle: {
                                borderColor: '#fff',
                                borderWidth: 1
                            },
                            emphasis: {
                                label: {
                                    fontSize: 20
                                }
                            },
                            markLine:{
                                symbol:'none',
                                lineStyle:{type:'solid'},
                                data: [
                                    [{x:'35%',y:'18%'},{x:'90%',y:'18%',value:this.huizhang+'个',lineStyle:{color:colorList[0]}}],
                                    [{x:'35%',y:'34%'},{x:'90%',y:'34%',value:this.fuhui+'个',lineStyle:{color:colorList[1]}}],
                                    [{x:'35%',y:'50%'},{x:'90%',y:'50%',value:this.ganshi+'个',lineStyle:{color:colorList[2]}}],
                                    [{x:'35%',y:'66%'},{x:'90%',y:'66%',value:this.chengyuan+'个',lineStyle:{color:colorList[3]}}],
                                    [{x:'35%',y:'82%'},{x:'90%',y:'82%',value:this.putong+'个',lineStyle:{color:colorList[4]}}],
                                ]
                            },
                            data: [
                                {value: 1, name: '会长'},
                                {value: 2, name: '副会长'},
                                {value: 3, name: '干事'},
                                {value: 4, name: '社团成员'},
                                {value: 5, name: '普通会员'}
                            ]
                        }
                    ]
                };
                
                myChart.setOption(option);
            },

        }
    }
</script>

<style scoped>
    #main6>div{
        width: 100% !important;
    }
    #main6{
        width: 100%;
        height: 100%;
    }
    #main6>div>canvas{
        cursor: pointer;
        width: 100% !important;
    }
</style>