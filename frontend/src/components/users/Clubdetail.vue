<template>
    <div>
        <v-header></v-header>
        <div class="indexMain">
            <div class="indexMain_left">
                <!-- 社团简介 -->
                <div class="tzCon">
                    <div class="tzCon_head">
                        <div class="tzCon_head_left"><img :src="ClubMes.c_img"/></div>
                        <div class="tzCon_head_right">
                            <h1>{{ClubMes.c_name}}</h1>
<!--                             <ul>
                                <li>{{actionDetail.a_unit}}</li>
                                <li>{{actionDetail.update_time}}</li>
                                <li>21</li>
                            </ul> -->
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="tzCon_con" >
                        <el-form :model="ClubMes" class="colstyle"> 
                            <el-form-item label="社团简介：" :label-width="formLabelWidth">
                                {{ClubMes.c_introduce}}
                            </el-form-item>
                             <el-form-item label="社团性质：" :label-width="formLabelWidth">
                                  {{ClubMes.c_nature}}
                            </el-form-item>
                            <el-form-item label="主管单位：" :label-width="formLabelWidth">
                                {{ClubMes.c_manage}}
                            </el-form-item>
                            <el-form-item label="现任社长：" :label-width="formLabelWidth">
                                {{ClubMes.c_boss}}
                            </el-form-item>
                            <el-form-item label="社团成立时间：" :label-width="formLabelWidth">
                                {{ClubMes.create_time}}
                            </el-form-item>
                        </el-form>
                    </div>
                    <!-- <div class="tzCon_foot">
                        <div class="tzCollect">
                            <div class="tzCollect_left">收藏</div>
                            <div class="tzCollect_right">131</div>
                        </div>
                    </div> -->
                </div>

                <div class="indexMain_left_btn">
                    <ul>
                        <li><a href="javascript:">社团动态</a></li>
                    </ul>
                </div>

                <!-- 社团发布的信息 -->
                <div class="indexMain_left_con" v-for="item in tempList" :key="item.id">
                    <div class="indexCon_msg">
                        <!-- <div class="indexCon_msg_pic"><img :src="item.clubid.c_img"/></div> -->
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
                                    <li>{{item.clubid.c_name}}</li>
                                    <li>{{item.update_time}}</li>
                                    <li>{{item.likenum}}</li>
                                    <li>{{item.comnum}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>  
                </div>

                <!-- 分页 -->
                <div class="indexFooter">
                    <div class="indexFooter_con">
                        <el-pagination
                          background
                          @current-change="handleCurrentChange" 
                          :current-page="currentPage"
                          :page-size="pageSize"
                          layout="prev, pager, next, ->, total"
                          :total="total"
                          >
                        </el-pagination>
                    </div>
                </div>
            </div>

            <div class="indexMain_right">
                
                <div class="myMsg">
                    <div class="myMsg_con">
                        <div class="myMsg_conPic clubImg"><img :src="ClubMes.c_img"/></div>
                        <p>{{ClubMes.c_name}}</p>
                    </div>
                    <a href="" class="newMsg joinbtn" @click="ToshowJoin(ClubMes.id)">申请加入</a>
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
        name:'Clubdetail',
        data(){
            return{
                ActionMes:[],
                ClubMes:{},
                imgUrl:'http://www.clubs.org',
                formLabelWidth: '120px',
                //分页：
                total:0,
                currentPage:1,
                pageSize:6,
                tempList:[],
            }
        },
        methods:{
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
            //获取社团动态列表
            getClubaction(){    
                let c_id=this.$route.query.id;
                // console.log(a_id);
                this.apiGet('http://www.clubs.org/index.php/' +  'getAllAction').then((res)=>{
                    if(res.code==200){
                        res.data.forEach((val)=>{
                            if(val.clubid==c_id && val.ispass==1){
                                this.apiGet('http://www.clubs.org/index.php/' +  'getClub',{params:{id:val.clubid}})
                                .then((ret) => {
                                    if(ret.code=200){
                                        ret.data.c_img=this.imgUrl+ret.data.c_img;
                                        val.clubid=ret.data;
                                    }else{
                                        this.common.toastMsg('信息出错','warn');
                                    }
                                });
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
                            }  
                        });
                        // console.log(this.ActionMes);
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                }).then(()=>{
                    console.log(this.ActionMes);
                    this.total=this.ActionMes.length;
                    this.currentChangePage(this.ActionMes,1);
                  });
            },
            getClubMes(){
                let c_id=this.$route.query.id;
                this.apiGet('http://www.clubs.org/index.php/' +  'getClub',{params:{id:c_id}}).then((res)=>{
                    if(res.code==200){
                        res.data.c_img=this.imgUrl+res.data.c_img;
                        res.data.create_time=this.common.toDate(res.data.create_time);
                        this.ClubMes=res.data;
                        // console.log(this.ClubMes);
                    }else{
                        this.common.toastMsg('信息出错','warn');
                    }
                });
            },
            Toshowmore(item){
                this.$router.push({
                    path:'Actionmore',
                    query:{id:item.id}
                });
            },
            ToshowJoin(clubId){
                this.$router.push({
                    path:'Joinclub',
                    query:{id:clubId}
                });
            }
        },
        created(){
            this.getClubaction();
            this.getClubMes();
        },
        components: {
          vHeader,
          vFooter
        },
        mixins:[http],
    }
</script>

<style scoped>
    .joinbtn{
        border-radius: 3px;
    }
</style>