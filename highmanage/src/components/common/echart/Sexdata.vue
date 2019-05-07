<template>
    <div id="main5" class="chartAll">                           
    </div>
</template>

<script>
    import echarts from 'echarts'
    export default{
        name:'Sexdata',
        data(){
            return{
                Nan:'',
                Nv:''
            }
        },
        mounted(){
            this.getMember();
        },
        methods:{
            getMember(){
                this.$axios.get('http://www.clubs.org/index.php/getAllMember')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let nan =[];
                        let nv =[];
                        ret.data.forEach((val)=>{
                            if(val.m_sex=="男"){
                                nan.push(val);
                            }
                            if(val.m_sex=="女"){
                                nv.push(val);
                            }
                        });
                        this.Nan=nan.length;
                        this.Nv=nv.length;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                .then(()=>{
                    this.DrawRadar();
                })
            },
            DrawRadar(){
                var myChart5 = echarts.init(document.getElementById('main5'));
                var option5 = {
                    // backgroundColor: "#03141c",
                    title: {
                        text: "男女比例",
                        subtext: '会员',
                        x: 'center',
                        y: 'center',
                        textStyle: {
                            color: "#fff",
                            fontSize: 30,
                            fontWeight: 'normal'
                        },
                        subtextStyle: {
                            color: "rgba(255,255,255,.45)",
                            fontSize: 14,
                            fontWeight: 'normal'
                        }
                    },
                    tooltip: {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)",
                        extraCssText:'width:200px !important;background:rgba(5,34,77,0.7)',
                    },
                    legend: {
                        x: 'center',
                        y: 'bottom',
                        data: ['rose3', 'rose5', 'rose6', 'rose7', 'rose8']
                    },
                    calculable: true,
                    series: [

                        {
                            name: '男女比例',
                            type: 'pie',
                            radius: [100, 130],
                            center: ['50%', '50%'],
                            data: [
                                {
                                    value: this.Nv,
                                    name: '女',
                                    itemStyle: {

                                        color: new echarts.graphic.LinearGradient(0, 1, 0, 0, [{
                                            offset: 0,
                                            color: '#f6e3a1'
                                        }, {
                                            offset: 1,
                                            color: '#ff4236'
                                        }])
                                    },
                                    label: {
                                        color: "rgba(255,255,255,.45)",
                                        fontSize: 14,
                                        formatter: '女生\n{a|'+this.Nv+'}个',
                                        rich: {
                                            a: {
                                                color: "#fff",
                                                fontSize: 20,
                                                lineHeight: 30
                                            },
                                        }
                                    }
                                },
                                {
                                    value: this.Nan,
                                    name: '男',
                                    itemStyle: {
                                        color: "transparent"
                                    }
                                }
                            ]
                        },
                        {
                            name: '男女比例',
                            type: 'pie',
                            radius: [110, 120],
                            center: ['50%', '50%'],
                            data: [
                                {
                                    value: this.Nv,
                                    name: '女',
                                    itemStyle: {
                                        color: "transparent"
                                    }
                                },
                                {
                                    value: this.Nan,
                                    name: '男',
                                    itemStyle: {

                                        color: new echarts.graphic.LinearGradient(0, 1, 0, 0, [{
                                            offset: 0,
                                            color: '#348fe6'
                                        }, {
                                            offset: 1,
                                            color: '#625bef'
                                        }])
                                    },
                                    label: {
                                        color: "rgba(255,255,255,.45)",
                                        fontSize: 14,
                                        formatter: '男生\n{a|'+this.Nan+'}个',
                                        rich: {
                                            a: {
                                                color: "#fff",
                                                fontSize: 20,
                                                lineHeight: 30
                                            },
                                        }
                                    }
                                }
                            ]
                        }
                    ]
                };
                myChart5.setOption(option5);
            },
        }
    }
</script>

<style scoped>
    #main5>div{
        width: 100% !important;
    }
    #main5{
        width: 100%;
        height: 100%;
    }
    #main5>div>canvas{
        cursor: pointer;
        width: 100% !important;
    }
</style>