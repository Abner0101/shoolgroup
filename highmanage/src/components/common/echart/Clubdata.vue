<template>
        <div id="main2" class="chartAll">
        </div>
</template>

<script>
    import echarts from 'echarts'
    export default{
        name:'Clubdata',
        data(){
            return{
                Renwen:'',
                Yishu:'',
                Tiyu:'',
                Keji:'',
                Fuwu:''
            }
        },
        mounted() {
            this.getClub();
        },
        methods:{
            getClub(){
                 this.$axios.get('http://www.clubs.org/index.php/getAllClub')
                .then((res)=>{
                    let ret=res.data;
                    if(ret.code == 200){
                        let renwen = [];
                        let keji = [];
                        let yishu = [];
                        let tiyu = [];
                        let fuwu = [];
                        ret.data.forEach((val)=>{
                            if(val.ispass==1){
                                if(val.c_nature=="人文类"){
                                    renwen.push(val);
                                }
                                if(val.c_nature=="科技类"){
                                    keji.push(val);
                                }
                                if(val.c_nature=="艺术类"){
                                    yishu.push(val);
                                }
                                if(val.c_nature == "体育类"){
                                    tiyu.push(val);
                                }
                                if(val.c_nature == "服务类"){
                                    fuwu.push(val);
                                }
                            }  
                        });
                        this.Renwen=renwen.length;
                        this.Keji=keji.length;
                        this.Yishu=yishu.length;
                        this.Tiyu=tiyu.length;
                        this.Fuwu=fuwu.length;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                .then(()=>{
                    this.DrawClubChart();
                })
            },
            DrawClubChart(){
                var myChart2 = echarts.init(document.getElementById('main2'));
                var option = {
                  title:{
                      text:'社团分布比例',                     
                      left:'center',
                      textStyle:{
                        color:'#fff',
                        fontFamily:'monospace'
                      },
                  },
                  tooltip: {
                      trigger: 'item',
                      formatter: "{a} <br/>{b}: {c} ({d}%)",
                      extraCssText:'width:200px !important;background:rgba(5,34,77,0.7)',
                  },
                  legend: {
                      orient: 'vertical',
                      x: 'left',
                      data:['人文类','艺术类','体育类','服务类','科技类'],
                      textStyle:{
                        color:'#fff'
                      }
                  },
                  series: [
                      {
                          name:'访问来源',
                          type:'pie',
                          radius: ['50%', '70%'],
                          avoidLabelOverlap: false,
                          label: {
                              normal: {
                                  show: false,
                                  position: 'center'
                              },
                              emphasis: {
                                  show: true,
                                  textStyle: {
                                      fontSize: '30',
                                      fontWeight: 'bold'
                                  }
                              }
                          },
                          labelLine: {
                              normal: {
                                  show: false
                              }
                          },
                          data:[
                              {value:this.Renwen, name:'人文类'},
                              {value:this.Yishu, name:'艺术类'},
                              {value:this.Tiyu, name:'体育类'},
                              {value:this.Fuwu, name:'服务类'},
                              {value:this.Keji, name:'科技类'}
                          ]
                      }
                  ]
              };

                myChart2.setOption(option);
            },


        }
    }
</script>

<style scoped>
    #main2>div{
        width: 100% !important;
    }
    #main2{
        width: 100%;
        height: 100%;
    }
    #main2>div>canvas{
        cursor: pointer;
        width: 100% !important;
    }
</style>