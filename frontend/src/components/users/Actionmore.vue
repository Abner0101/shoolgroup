<template>
    <div>
        <v-header></v-header>
        <div class="indexMain">
            <div class="indexMain_left">
                <div class="tzCon" v-if="actionDetail">
                    <div class="tzCon_head">
                        <div class="tzCon_head_left"><img :src="clubImg"></div>
                        <div class="tzCon_head_right">
                            <h1>{{actionDetail.a_theme}}</h1>
                            <ul>
                                <li>{{actionDetail.a_unit}}</li>
                                <li>{{actionDetail.update_time}}</li>
                                <li></li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="tzCon_con" >
                        <div v-html="actionDetail.a_content"></div>
                    </div>
                    <div class="tzCon_foot">
                        <div class="tzCollect">
                            <div class="tzCollect_left" @click="Like" :class="{ on: isActive }">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;感兴趣</div>
                            <div class="tzCollect_right">{{joinnum}}</div>
                        </div>
                    </div>
                </div>

                <div class="newPending">
                    <div class="newPending_head">
                        <div class="tzHeng"></div>
                        <div class="newPending_head_tittle">最新评论({{commentnum}})</div>
                    </div>
                    <!--楼主可以删除评论、自己可以删除自己的评论删除按钮酌情出现-->
                    <div v-for="item in tempList" :key="item.id">
                        <div class="newPending_son">
                            <div class="pendPic"><img :src="item.memberId.m_img" /></div>
                            <div class="pendDetail">
                                <div class="pendDetail_head">
                                    <p>{{item.memberId.m_name}}<span>{{item.c_time}}</span></p>
                                    <i @click="getOtherCommentMes(item)" v-if="showComment==item.id">收起</i>
                                    <i @click="getOtherCommentMes(item)" v-if="showComment!=item.id">展开评论</i>
                                    <i @click="getOtherCommentMes(item)" v-if="OtherComMes=='' && showComment==item.id" >暂无评论</i>
                                </div>
                                <div class="pendDetail_con">
                                    <p>{{item.content}}</p>
                                </div>
                                <div v-if="showComment==item.id" v-for="row in OtherComMes" :key="row.id">
                                    <div class="pendDetail_replayCon">
                                        <p>@{{row.o_memberId.m_name}}：{{row.o_content}}</p>
                                    </div>
                                </div>
                                <div class="pendDetail_btn">
                                    <ul>
                                        <li class="replayBtn" @click="Tomomment(item.id)">{{item.othercommentnum}}</li>
                                        <li class="delateBtn" v-if="item.memberId.id==memberId" @click="delComment(item.id)">删除</li>
                                    </ul>
                                </div>
                                <div class="pendDetail_action" v-if="showTocomment == item.id">
                                    <input type="text" placeholder="..." v-model="othercontent"/>
                                    <button @click="subOthercom(item)">评论</button>
                                    <button @click="cancelToComment">取消</button>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <!--测试内容结束、十条内容分页-->
                </div>
                <div class="indexFooter">
                    <div class="indexFooter_con">
                        <el-pagination
                          background
                          @current-change="handleCurrentChange" 
                          :current-page="currentPage"
                          :page-size="pageSize"
                          layout="prev, pager, next, ->, jumper,total"
                          :total="total"
                          >
                        </el-pagination>
                    </div>
                </div>
                <div class="writePending">
                    <div class="newPending_head">
                        <div class="tzHeng"></div>
                        <div class="newPending_head_tittle">评论</div>
                    </div>
                    <div class="writePending_con">
                        <input type="text" placeholder="写下你的评论..." v-model="com_content"/>
                        <input type="submit" @click="subComment" value="评论"/>
                    </div>
                </div>
            </div>
            <div class="indexMain_right">
                <!-- <a href="" class="newMsg">加入{{actionDetail.clubid.c_name}}</a> -->
                <div class="myMsg" v-if="actionDetail">
                    <div class="myMsg_con">
                        <div class="myMsg_conPic clubImg" @click="showClub(actionDetail.clubid.id)"><img :src="clubImg"></div>
                        <p>{{actionDetail.a_unit}}</p>
                    </div>
                    <div  class="myMsg_footer">
                        <ul>
                            <li><a href="javascript:;">
                                <p>现任社长</p>
                                <p>{{actionDetail.clubid.c_boss}}</p>
                            </a></li>
                            <li><a href="javascript:;">
                                <p>社团性质</p>
                                <p>{{actionDetail.clubid.c_nature}}</p>
                            </a></li>
                            <li><a href="javascript:;">
                                <p>成立日期</p>
                                <p>{{actionDetail.clubid.create_time}}</p>
                            </a></li>
                        </ul>
                    </div>
                </div>
                <div class="indexSearch">
                    <input type="text" placeholder="请输入关键词"/>
                    <input type="submit" value="搜索"/>
                </div>
                <div class="indexPublic">
                    <div class="indexPublic_head">
                        友情链接
                    </div>
                    <div class="indexPublic_con">
                        <ul class="weekHot">
                            <li><a href="https://jwxt.dgut.edu.cn/jwxt" target="_blank">教务网路管理系统入口</a></li>
                            <li><a href="http://dgut.co.cnki.net/Login.html" target="_blank">大学生毕业设计（论文）管理系统</a></li>
                            <li><a href="http://jwc.dgut.edu.cn/jyk/" target="_blank">毕业生调查问卷</a></li>
                            <li><a href="http://219.222.191.146/defaultnew.aspx" target="_blank">实验室综合管理系统</a></li>
                            <li><a href="https://syb.dgut.edu.cn/" target="_blank">实践教学管理系统</a></li>
                            <li><a href="http://219.222.189.79:8080/" target="_blank">自助打印在线验证</a></li>
                        </ul>
                    </div>
                </div>
                <div class="indexPublic">
                    <div class="indexPublic_head">
                        校园资源
                    </div>
                    <div class="indexPublic_con">
                        <ul class="indexLink">
                            <li><a href="http://kc.dgut.ulearning.cn/" target="_blank">专业课程</a></li>
                            <li><a href="http://dglgxy.zlgc2.chaoxing.com/" target="_blank">质量工程</a></li>
                            <li><a href="http://jpkc.dgut.edu.cn/" target="_blank">精品课程</a></li>
                            <li><a href="http://jwc.dgut.edu.cn/jxms/" target="_blank">教学名师</a></li>
                            <li><a href="https://dgut.ulearning.cn/organization/index.html#/index/portal" target="_blank">优学院教学云平台</a></li>
                            <li><a href="http://gjyj.dgut.edu.cn/" target="_blank">高等教育研究所</a></li>
                            <li><a href="http://pjb.dgut.edu.cn/itest/itest/login" target="_blank">本科教学工作评建网</a></li>
                        </ul>
                    </div>
                </div>
                <div class="indexWxpublic">
                    <p>关注微信公众号</p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <v-footer></v-footer>
    </div>
    
</template>

<script>
    import vHeader from './common/Homeheader.vue'
    import vFooter from './common/Homefooter.vue'
    import http from '../../assets/js/http.js'
    import '../../assets/css/public.css'
    export default {
        name:'ActionMore',
        data() {
            return{
                actionDetail:null,
                imgUrl:'http://www.clubs.org',
                memberId:sessionStorage.getItem('m_id'),
                clubImg:'',
                isActive:null,
                commentId:'',//感兴趣ID
                joinnum:'',
                com_content:null,
                commentnum:'',//评论数目
                commentMes:null,//评论信息
                pinglunId:'',//评论id
                othercontent:'',//其他会员评论内容
                // showCommentId:'',
                OtherComMes:'',//其他评论信息
                o_commentId:'',//展开评论时调用的评论ID
                // noComment:false,
                // dialogFormVisible: false,
                //分页：
                total:0,
                currentPage:1,
                pageSize:6,
                tempList:[],

            }
        },
        computed:{
            showTocomment(){
                return this.pinglunId;
            },
            showComment(){
                return this.o_commentId;
            }
        },
        methods:{

            handleCurrentChange(currentPage) {//页码切换
                this.currentPage = currentPage
                this.currentChangePage(this.commentMes,currentPage)  
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
            //获取公告信息
            getDetail(){
                let a_id=this.$route.query.id;
                // console.log(a_id);
                this.apiGet('http://www.clubs.org/index.php/' +  'getAction',{params:{id:a_id}}).then((res)=>{
                    if(res.code==200){
                        this.apiGet('http://www.clubs.org/index.php/' +  'getClub',{params:{id:res.data.clubid}})
                        .then((ret)=>{
                            if(ret.code==200){
                                this.clubImg=this.imgUrl+ret.data.c_img;
                                ret.data.create_time=this.common.toDate(ret.data.create_time);
                                res.data.clubid=ret.data;
                            }else{
                                this.common.toastMsg('信息出错','warn');
                            }
                        });
                        // let temp=res.data
                        // console.log(temp);
                        res.data.update_time=this.common.toDate(res.data.update_time);
                        this.actionDetail=res.data;
                        console.log(this.actionDetail);
                        // this.actionDetail.push(res.data);
                        // this.actionDetail=res.data;
                        
                    }else{
                        this.common.toastMsg('信息出错','warn');   
                    }
                });     
            },
            Tomomment(id){
                this.pinglunId=id;
            },
            cancelToComment(){
                this.pinglunId='';
            },
            subOthercom(item){
                
                if(this.othercontent==null){
                    this.common.toastMsg("评论内容不能为空",'warning');
                }else{
                    let params ={
                        o_content:this.othercontent,
                        o_memberId:sessionStorage.getItem('m_id'),
                        o_commentId:item.id,
                        o_time:this.common.toGetTime(),
                        o_actionId:item.actionId,
                        becommenterId:item.memberId.id
                    }
                    this.apiPost('http://www.clubs.org/index.php/' +  'addOtherComment',params).then((res)=>{
                        if(res.code == 200){
                            this.common.toastMsg('评论成功','success');
                            this.pinglunId='';
                            this.getCommentMes();
                            this.othercontent=null;//清空评论框
                        }else if (res.code == 101){
                            this.handleError();
                        }else{
                            this.common.toastMsg(res.error,'error');
                        }
                    });
                }
                console.log(this.othercontent);
                console.log(item);
            },
            delComment(comid){
                this.apiGet('http://www.clubs.org/index.php/' +  'delComment',{params:{id:comid}}).then((res)=>{
                    if(res.code == 200){
                        this.common.toastMsg('删除成功','success');
                        this.getCommentMes();
                    }else if(res.code == 101){
                        this.handleError()
                    }else{
                        this.common.toastMsg(res.error,'error');
                    }
                });
            },
            getOtherCommentMes(item){
                if(this.o_commentId==""){
                    this.o_commentId=item.id; //这里的o_commentId为data声明的变量
                    let Ocomment = [];
                    this.apiGet('http://www.clubs.org/index.php/' +  'getAllOtherComment').then((res)=>{
                        if(res.code =  200){
                            res.data.forEach((val)=>{
                                if(val.o_commentId==item.id){  //这里的o_commentId为数据表的字段名
                                    this.apiGet('http://www.clubs.org/index.php/' +  'getMember',{params:{id:val.o_memberId}}).then((ret)=>{
                                        if(ret.code == 200){
                                            val.o_memberId=ret.data;
                                        }else{
                                            this.common.toastMsg('信息出错','warn');
                                        }
                                    });
                                    Ocomment.push(val);
                                }
                            })
                        }else{
                            this.common.toastMsg('信息出错','warn');
                        }
                    }).then(()=>{
                        this.OtherComMes=Ocomment;
                    });
                    // console.log(this.OtherComMes);

                }else{
                    this.o_commentId="";
                }
                
            },
            getCommentMes(){
                let num = 0;
                let a_id=this.$route.query.id;
                let comment = [];
                this.apiGet('http://www.clubs.org/index.php/' +  'getAllComment').then((res)=>{
                    if(res.code == 200){
                        res.data.forEach((val)=>{
                            if(val.actionId==a_id){
                                num++;
                                this.apiGet('http://www.clubs.org/index.php/' +  'getMember',{params:{id:val.memberId}}).then((ret)=>{
                                    if(ret.code == 200){
                                        ret.data.m_img=this.imgUrl+ret.data.m_img;
                                        val.memberId=ret.data;
                                    }else{
                                        this.common.toastMsg('信息出错','warn');
                                    }
                                });
                                let o_num=0;
                                this.apiGet('http://www.clubs.org/index.php/' +  'getAllOtherComment').then((com)=>{
                                    if(com.code == 200){
                                        console.log(com.data);
                                            com.data.forEach((comval)=>{
                                                if(comval.o_commentId==val.id){
                                                    o_num++;
                                                }
                                            });
                                    }else{
                                        this.common.toastMsg('信息出错','warn');
                                    }
                                }).then(()=>{
                                    val.othercommentnum=o_num;
                                });
                                comment.push(val);
                            }
                            
                        })
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                }).then(()=>{
                    this.total=comment.length;
                    this.commentMes=comment;
                    this.currentChangePage(this.commentMes,1);
                    this.commentnum=num;
                    console.log(this.commentMes);
                    console.log(this.commentnum);
                });
                
            },

            //获取参加活动的数据
            getLike(){
                let a_id=this.$route.query.id;
                let num = 0;
                this.apiGet('http://www.clubs.org/index.php/' +  'getAllLike').then((res)=>{
                    if(res.code == 200){
                        res.data.forEach((val)=>{
                            if(val.l_actionId==a_id){
                                num++;
                            }
                            if(val.l_actionId==a_id && val.l_memberId == sessionStorage.getItem('m_id')){
                                this.isActive=true;
                                this.commentId=val.id;
                            }
                            // else{
                            //     this.isActive=false;
                            // }
                        })
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                }).then(()=>{
                    this.joinnum=num;
                });
            },

            showClub(id){
                this.$router.push({
                    path:'Clubdetail',
                    query:{id:id}
                });
            },

            Like(){
                let params={
                    l_actionId:this.actionDetail.id,
                    l_memberId:sessionStorage.getItem('m_id')
                };
                if(this.isActive != true){
                    let params={
                        l_actionId:this.actionDetail.id,
                        l_memberId:sessionStorage.getItem('m_id')
                    };
                    this.apiPost('http://www.clubs.org/index.php/' +  'addLike',params).then((res)=>{
                        if(res.code == 200){
                            this.common.toastMsg('已报名参加','success');
                            this. getLike();
                        }else if (res.code == 101){
                            this.handleError();
                        }else{
                            this.common.toastMsg(res.error,'error');
                        }
                    });
                }else{
                    // console.log(this.commentId);
                    let params={
                        id:this.commentId
                    };
                   this.apiGet('http://www.clubs.org/index.php/' +  'delLike',{params}).then((res)=>{
                        if(res.code == 200){
                            this.common.toastMsg('已取消参加','warning');
                            this. getLike();
                        }else if (res.code == 101){
                            this.handleError();
                        }else{
                            this.common.toastMsg(res.error,'error');
                        }
                    }).then(()=>{
                        this.isActive=false;
                    });
                }
                
            },

            subComment(){
                if(this.com_content==null){
                    this.common.toastMsg("评论内容不能为空",'warning');
                }else{
                    let params={
                        content:this.com_content,
                        actionId:this.$route.query.id,
                        memberId:sessionStorage.getItem('m_id'),
                        c_time:this.common.toGetTime()
                    }
                    this.apiPost('http://www.clubs.org/index.php/' +  'addComment',params).then((res)=>{
                        if(res.code == 200){
                            this.common.toastMsg('评论成功','success');
                            this.getCommentMes();
                            this.com_content=null;
                        }else if (res.code == 101){
                            this.handleError();
                        }else{
                            this.common.toastMsg(res.error,'error');
                        }
                    });
                }
            }
        },
        mounted(){
            this.getLike();
        },
        created(){
            this.getCommentMes();
            this.getDetail();
            
            // console.log(this.actionDetail);
        },
        components: {
          vHeader,
          vFooter
        },
        mixins:[http],

    }
</script>

<style scoped>
    .clubImg{
        cursor: pointer;
    }
</style>