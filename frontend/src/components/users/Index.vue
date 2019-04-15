<template>
    <div>
        <v-header></v-header>
        <div class="indexMain">
            <div class="indexMain_left">
                <!-- 轮播信息 -->
                <div class="indexMain_left_slide">
                    <el-carousel indicator-position="outside">
                        <el-carousel-item v-for="item in Actionshow" :key="item.id">
                            <img :src="item.coverimg" class="Show-img" @click="Toshowmore(item)">
                            <div class="slide-title"><p @click="Toshowmore(item)">{{item.a_theme}}</p></div>
                        </el-carousel-item>
                    </el-carousel>
                </div>

                <div class="indexMain_left_btn">
                    <ul>
                        <li><a href="javascript:">社团动态</a></li>
                        <li><a href="javascript:">置顶</a></li>
                        <li><a href="javascript:" class="on">最新</a></li>
                    </ul>
                </div>

                <!-- 社团发布的信息 -->
                <div class="indexMain_left_con" v-for="item in tempList" :key="item.id">
                    <div class="indexCon_msg">
                        <div class="indexCon_msg_pic"><img :src="item.clubid.c_img"/></div>
                        <div class="indexCon_msg_detail">
                            <a href="">
                                <div class="indexCon_msg_detail_tittle">
                                    <span>{{item.a_nature}}</span>
                                    <p @click="Toshowmore(item)">{{item.a_theme}}</p>
                                </div>
                            </a>
                            <div class="havePic" v-if="item.coverimg">
                                <a href=""><div class="havePic_head"><img :src="item.coverimg"/></div></a>
                            </div>
                            <div class="indexCon_msg_detail_other">
                                <ul>
                                    <li>{{item.a_unit}}</li>
                                    <li>{{item.update_time}}</li>
                                    <li>{{item.likenum}}</li>
                                    <li>{{item.comnum}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
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
            </div>

            <div class="indexMain_right">
                <div class="indexMain_rightCon">
                    <router-link to="/Clubcreate"><a class="newMsg">创建社团</a></router-link>
                    <router-link to="/Joinclub"><a class="newMsg">加入社团</a></router-link>
                    <div class="pwfb">
                        <div class="pwfbHead">
                            社团列表
                        </div>
                        <div class="pwfbCon">
                            <el-row class="elcard" v-for="item in ClubMes">  
                                <el-card shadow="hover">
                                  <div class="myMsgCon_pic" @click="ToshowClubMore(item.id)"><img :src="item.c_img"/></div>
                                  <p class="club-name" @click="ToshowClubMore(item.id)">{{item.c_name}}</p>
                                </el-card>
                            </el-row>
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
    name:'Index',
    data() {
        return{
            ActionMes:[],
            Actionshow:[],
            ClubMes:[],
            imgUrl:'http://www.clubs.org',
            //分页：
            total:0,
            currentPage:1,
            pageSize:6,
            tempList:[],
        }
    },
    mounted(){
        this.getAllaction();
        this.getAllClub();
    },
    methods: {
        handleCurrentChange(currentPage) {//页码切换
            this.currentPage = currentPage
            this.currentChangePage(this.ActionMes,currentPage)  
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
        getAllClub(){
            this.apiGet('http://www.clubs.org/index.php/' +  'getAllClub').then((res)=>{
                if(res.code == 200){
                    let tmp =[];
                    res.data.forEach((val)=>{
                        if(val.ispass==1){
                            val.c_img=this.imgUrl + val.c_img;
                            tmp.push(val);
                        }
                    })
                    this.ClubMes=tmp;
                }
            })
            // .then(()=>{
            //     console.log(this.ClubMes);
            // });
        },
        getAllaction(){
            this.apiGet('http://www.clubs.org/index.php/' +  'getAllAction').then((res) => {
            if(res.code == 200){
              res.data.forEach((val)=>{
                if(val.ispass==1){
                    this.apiGet('http://www.clubs.org/index.php/' +  'getClub',{params:{id:val.clubid}})
                    .then((res) => {
                        if(res.code=200){
                            res.data.c_img=this.imgUrl+res.data.c_img;
                            val.clubid=res.data;
                        }else{
                            this.common.toastMsg('信息出错','warn');
                        }
                    })
                    val.update_time=this.common.toDate(val.update_time);
                    if(val.coverimg=='null'){
                        val.coverimg=null;
                    }else{
                        val.coverimg=this.imgUrl+val.coverimg;
                    }
                    //获取评论数量
                    this.apiGet('http://www.clubs.org/index.php/' +  'getAllComment').then((res)=>{
                        if(res.code == 200){
                            let temp=[];
                            res.data.forEach((comval)=>{
                                if(comval.actionId == val.id){
                                    temp.push(comval);
                                }
                            });
                            val.comnum=temp.length;
                        }else{
                            this.common.toastMsg('信息出错','warn');
                        }
                    });
                    //获取感兴趣的人数
                    this.apiGet('http://www.clubs.org/index.php/' +  'getAllLike').then((res)=>{
                        if(res.code == 200){
                            let temp=[];
                            res.data.forEach((likeval)=>{
                                if(likeval.l_actionId == val.id){
                                    temp.push(likeval);
                                }
                            });
                            val.likenum=temp.length;
                        }else{
                            this.common.toastMsg('信息出错','warn');
                        }
                    });
                    this.ActionMes.push(val);
                    if(val.isshow==1){
                        this.Actionshow.push(val);
                    }
                }
              });
            }else{
               this.common.toastMsg('信息出错','warn');
            }
            // console.log(this.ActionMes);
            // console.log(this.Actionshow);
          }).then(()=>{
            console.log(this.ActionMes);
            this.total=this.ActionMes.length;
            this.currentChangePage(this.ActionMes,1);
          })
        },
        Toshowmore(item){
            this.$router.push({
                path:'Actionmore',
                query:{id:item.id}
            });
        },
        ToshowClubMore(clubId){
            this.$router.push({
                path:'Clubdetail',
                query:{id:clubId}
            });
        }
    },
    components: {
      vHeader,
      vFooter
    },
    mixins:[http],
  }
</script>

<style scoped>
    .club-name{
        font-size: 14px;
        color: #7D7F82;
        letter-spacing: 5px;
    }
    .myMsgCon_pic{
        width: 35px;
        height: 35px;
        margin-bottom: 10px;
        margin-top: -10px;
        margin-right: 15px;
        background-color: #999;
        float: left;
    }
    .myMsgCon_pic img{
        width: 35px;
        height: 35px;
    }
    .elcard{
        padding: 8px 20px;
        cursor: pointer;
    }
    .Show-img{
        width: 785px;
        height: 300px;
    }
    .slide-title {
        width:100%;
        height: 50px;
        background: rgba(0, 0, 0, 0.5);
        position: absolute;
        bottom: 0;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        cursor: pointer;
    }
    .slide-title p{
        color: #fff;
        font-size: 17px;
        line-height: 50px;
        letter-spacing: 3px;
        margin-left: 25px;
        font-family: "微软雅黑";
    }
    .el-carousel__item{
        height: 300px;
        border-radius: 10px;
        cursor: pointer;
    }
    .el-carousel__item h3 {
        color: #475669;
        font-size: 18px;
        opacity: 0.75;
        line-height: 300px;
        margin: 0;
    }
      
    .el-carousel__item:nth-child(2n) {
        background-color: #99a9bf;
    }
      
    .el-carousel__item:nth-child(2n+1) {
        background-color: #d3dce6;
    }
    
</style>