<template>
    <div class="Mypost">
        <el-tabs type="border-card" style="border-radius: 15px;margin: 15px 25px;">
            <el-tab-pane label="我的社团">
                <div v-if="clubMes[0]">
                    <div class="home_self">
                        <img :src="clubMes[0].c_img" alt="" @click="ToshowClubM(clubMes[0].id)"/>
                    </div>
                    <div class="home_name">
                        <p @click="ToshowClubM(clubMes[0].id)">{{clubMes[0].c_name}}</p>
                    </div>
                </div>
                
                <el-table :data="actionMes" :show-header="false" style="width: 100%">
                    <el-table-column>
                        <template slot-scope="scope">
                            <span class="message-title" @click="ToshowAction(scope.row.id)"><p>{{scope.row.a_theme}}</p></span>
                        </template>
                    </el-table-column>
                    <el-table-column prop="update_time" width="180"></el-table-column>
                </el-table>
            </el-tab-pane>

            <el-tab-pane label="感兴趣">
                <el-table :data="tempList" :show-header="false" style="width: 100%">
                    <el-table-column width="100">
                        <template slot-scope="scope">
                            <el-tag size="mini">{{scope.row.l_actionId.a_unit}}</el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column>
                        <template slot-scope="scope">
                            <span class="message-title"><p @click="ToshowLikeAct(scope.row.l_actionId.id)">{{scope.row.l_actionId.a_theme}}</p></span>
                        </template>
                    </el-table-column>
                    <el-table-column width="160" >
                        <template slot-scope="scope">
                            <img :src="scope.row.l_actionId.coverimg" class="Coverimg" v-if="scope.row.l_actionId.coverimg" @click="ToshowLikeAct(scope.row.l_actionId.id)"/>
                        </template>
                    </el-table-column>

                </el-table>

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
            </el-tab-pane>

        </el-tabs>
    </div>
</template>

<script>
    import http from '../../../../assets/js/http.js'
    export default {
        name:'Mypost',
        data() {
            return {
                message: 'first',
                showHeader: false,
                actionMes:[],
                clubMes:'',
                imgUrl:'http://www.clubs.org',
                ActionLikeMes:[],
                //分页
                total:0,
                currentPage:1,
                pageSize:5,
                tempList:[],
            }
        },
        methods: {

            handleCurrentChange(currentPage) {//页码切换
                this.currentPage = currentPage
                this.currentChangePage(this.ActionLikeMes,currentPage)  
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
            //跳转到感兴趣的公告页面
            ToshowLikeAct(actId){
                this.$router.push({
                    path:'Actionmore',
                    query:{id:actId}
                });
            },

            ToshowClubM(clubId){
                this.$router.push({
                    path:'Clubdetail',
                    query:{id:clubId}
                });
            },
            getLike(){
                this.apiGet('http://www.clubs.org/index.php/' +  'getAllLike').then((res)=>{
                    if(res.code == 200){
                        let temp = [];
                        res.data.forEach((val)=>{
                            if(val.l_memberId == sessionStorage.getItem('m_id')){
                                this.apiGet('http://www.clubs.org/index.php/' +  'getAction',{params:{id:val.l_actionId}}).then((ret)=>{
                                    if(ret.code == 200){
                                        if(ret.data.coverimg=='null'){
                                            ret.data.coverimg=null;
                                        }else{
                                            ret.data.coverimg=this.imgUrl+ret.data.coverimg;
                                        }
                                        val.l_actionId=ret.data;
                                    }else{
                                        this.common.toastMsg('信息出错','warn');
                                    }
                                });
                                temp.push(val);
                            }
                        });
                        this.ActionLikeMes=temp;
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                }).then(()=>{
                    console.log(this.ActionLikeMes);
                    this.total=this.ActionLikeMes.length;
                    this.currentChangePage(this.ActionLikeMes,1);
                });
            },
            //跳转到公告详情
            ToshowAction(actId){
                this.$router.push({
                    path:'Actionmore',
                    query:{id:actId}
                });
            },

            getAllAction(){
                this.apiGet('http://www.clubs.org/index.php/' +  'getAllTable').then((res)=>{
                    if(res.code == 200){
                        
                        res.data.forEach((val)=>{
                            if(val.memberId == sessionStorage.getItem('m_id') && val.station == 1){
                                let tmp = [];
                                var club = [];
                                this.apiGet('http://www.clubs.org/index.php/' +  'getAllAction').then((ret)=>{
                                    if(ret.code == 200){
                                        ret.data.forEach((actval)=>{
                                            if(actval.clubid == val.clubId && actval.ispass==1){
                                                actval.update_time=this.common.toDateTime(actval.update_time);
                                                tmp.push(actval);
                                            }
                                        })
                                    }else{
                                        this.common.toastMsg('信息出错','warn');
                                    }
                                });
                                
                                this.apiGet('http://www.clubs.org/index.php/' +  'getAllClub').then((clubres)=>{
                                    if(clubres.code == 200){
                                        clubres.data.forEach((clubval)=>{
                                            if(clubval.id == val.clubId){
                                                clubval.c_img=this.imgUrl+clubval.c_img;
                                                club.push(clubval);
                                            }
                                        });
                                    }else{
                                        this.common.toastMsg('信息出错','warn');
                                    }
                                });
                                this.actionMes=tmp;
                                this.clubMes=club;
                            }
                        });
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                })
                // .then(()=>{
                //     console.log(this.actionMes);
                //     console.log(this.clubMes);
                // })  
            }
        },
        mounted(){
            this.getAllAction();
            this.getLike();
        },
        mixins:[http],
    }
</script>

<style scoped>
    .message-title{
        cursor: pointer;
    }
    .message-title p:hover{
        color: #409EFF;
        text-decoration:underline;
    }
    .handle-row{
        margin-top: 30px;
    }
    .home_self{
        width: 168px;
        height: 168px;
        margin: 0 auto;
        background-color: #999;
        border-radius: 5px;
        overflow: hidden;
        margin-top: 15px;
    }
    .home_self img{
        width: 168px;
        height: 168px;
        border-radius: 5px;
        cursor: pointer;
    }
    .home_name{
        width: 100%;
        height: 30px;
        color: #333;
        margin-top: 10px;
        margin-bottom: 30px;
        position: relative;
    }
    .home_name p{
        box-sizing: border-box;
        padding: 0 30px;
        line-height: 30px;
        font-size: 24px;
        position: absolute;
        left: 50%;
        cursor: pointer;
        transform: translateX(-50%);
    }
    .home_name p:hover{
        text-decoration:underline;
    }
    .Coverimg{
        width: 150px;
        height: 80px;
        cursor: pointer;
    }
</style>