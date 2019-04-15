<template>
    <div>
        <div class="baseHead">
            <p>我的消息</p>
        </div>
        <div class="myWrite_con">
            <div class="myMsgCon" v-if="tempList" v-for="item in tempList">
                <div class="myMsgCon_pic"><img :src="item.o_memberId.m_img"/></div>
                <div class="myMsgCon_detail">
                    <a @click="ToshowMore(item.o_actionId)">@{{item.o_memberId.m_name}} 回复你：{{item.o_content}}</a>
                </div>
                <p class="myMsgCon_time">{{item.create_time}}</p>
            </div>
        </div>
        <div class="indexFooter">
            <div class="indexFooter_con">
                <el-pagination
                  background
                  @current-change="handleCurrentChange" 
                  :current-page="currentPage"
                  :page-size="pageSize"
                  layout="prev, pager, next, ->,total"
                  :total="total"
                  >
                </el-pagination>
            </div>
        </div>
    </div>
</template>

<script>
    import http from '../../../../assets/js/http.js'
    export default {
        name:'Mymessage',
        data() {
            return{
                OtherComMes:[],
                imgUrl:'http://www.clubs.org',

                //分页
                total:0,
                currentPage:1,
                pageSize:11,
                tempList:[],
            }
        },
        methods:{
            ToshowMore(actId){
                this.$router.push({
                    path:'Actionmore',
                    query:{id:actId}
                });
            },
            handleCurrentChange(currentPage) {//页码切换
                this.currentPage = currentPage
                this.currentChangePage(this.OtherComMes,currentPage)  
            },
            currentChangePage(list,currentPage) { 
              let from = (currentPage - 1) * this.pageSize;
              let to = currentPage * this.pageSize;
              this.tempList = [];
              for (; from < to; from++) {
                if (list[from]) {
                  this.tempList.push(list[from]);
                }
              }
            },
            getOtherComMes(){
                this.apiGet('http://www.clubs.org/index.php/' +  'getAllOtherComment').then((res)=>{
                    if(res.code == 200){
                        let temp=[];
                        res.data.forEach((val)=>{
                            if(val.becommenterId == sessionStorage.getItem('m_id')){
                                this.apiGet('http://www.clubs.org/index.php/' +  'getMember',{params:{id:val.o_memberId}}).then((ret)=>{
                                    if(ret.code == 200){
                                        ret.data.m_img=this.imgUrl+ret.data.m_img;
                                        val.o_memberId=ret.data;
                                    }else{
                                        this.common.toastMsg('信息出错','warn');
                                    }
                                });
                                val.create_time=this.common.toDateTime(val.create_time);
                                temp.push(val);
                            }
                        });
                        this.OtherComMes=temp;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                .then(()=>{
                    console.log(this.OtherComMes);
                    this.total=this.OtherComMes.length;
                    this.currentChangePage(this.OtherComMes,1);
                });
            }
        },
        mounted(){
            this.getOtherComMes();
        },
        mixins:[http],
  }
</script>

<style scoped>
    .baseHead{
        width: 95%;
        height: 40px;
        background-color: #f2f2f2;
        border-radius: 10px;
        border: 1px solid #d7d7d7;
        margin: 15px 25px;

    }
    .baseHead p{
        font-size: 14px;
        color: #838586;
        text-indent: 40px;
        line-height: 40px;
    }
    .myWrite_con{
        width: 860px;
        height: 440px;
        border: 1px solid #e8e8e8;
        border-radius: 8px;
        margin-top: 30px;
        margin-left: 60px;
        box-shadow: 0 0 10px #999;
    }
    .myMsgCon{
        box-sizing: border-box;
        width: 100%;
        height: 40px;
        border-bottom: 2px solid #e8e8e8;
        padding-left: 24px;
        padding-right: 32px;
    }
    .myMsgCon:hover{
        background-color: #f8f8f8;
    }
    .myMsgCon:first-of-type{
        border-radius: 5px 5px 0 0;
    }
    .myMsgCon_pic{
        width: 20px;
        height: 20px;
        margin-top: 10px;
        background-color: #999;
        float: left;
    }
    .myMsgCon_pic img{
        width: 20px;
        height: 20px;
    }
    .myMsgCon_detail{
        width: 600px;
        height: 100%;
        line-height: 36px;
        float: left;
        margin-left: 15px;
        overflow: hidden;
    }
    .myMsgCon_detail a{
        color: #666;
    }
    .myMsgCon_detail a:hover{
        color: #409EFF;
        text-decoration:underline;
        cursor: pointer;
    }
    .myMsgCon_time{
        float: right;
        line-height: 36px;
        color: #666;
    }
    .indexFooter{
        width: 100%;
        height: 40px;
        position: relative;
        margin-top: 14px;
    }
    .indexFooter_con{
        position: absolute;
        height: 40px;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 0 10px #999;
        border-radius: 10px;
    }
    .indexFooter_con a{
        display: block;
        width: 40px;
        height: 40px;
        float: left;
        background-color: #fff;
        border-right: 1px dashed #cecece;
        font-size: 14px;
        color: #666;
        text-align: center;
        line-height: 45px;
    }
    .indexFooter_con a:first-of-type{
        border-radius: 10px 0 0 10px;
    }
    .indexFooter_con a:last-of-type{
        border-radius: 0 10px 10px 0;
        border-right: none;
    }
    .indexFooter_con a.on {
        background-color: #e43e20;
        border-right: none;
        color: #fff;
    } 
</style>